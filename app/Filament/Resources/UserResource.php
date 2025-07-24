<?php

namespace App\Filament\Resources;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\Enums\IconSize;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms;
use App\Rules\EmailUniqueAcrossTablesRule;
use App\Models\User;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\Pages;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'ri-group-line';

    protected static ?string $navigationGroup = 'Administration';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->hintIcon('ri-information-line')
                    ->hintIconTooltip('Upon account creation, an email containing the account details will be sent to the provided address.')
                    ->required()
                    ->string()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->rule(fn($record) => new EmailUniqueAcrossTablesRule($record))
                    ->maxLength(255)
                    ->columnSpanFull(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->withoutGlobalScopes([SoftDeletingScope::class])
                    ->where('id', '!=', auth()->id());
            })
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->actions([
                self::getEditAction(),
                self::getPasswordResetAction(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
        ];
    }

    // Actions

    // Edit Action
    public static function getEditAction(): Tables\Actions\EditAction
    {
        return Tables\Actions\EditAction::make()
            ->iconButton()
            ->iconSize(IconSize::Large)
            ->successNotificationMessage(fn($record) => "The user '{$record->name}' has been updated.")
            ->modalWidth(MaxWidth::Large)
            ->closeModalByClickingAway(false);
    }

    // Reset Password Action
    public static function getPasswordResetAction(): Tables\Actions\Action
    {
        $raw_password = Str::random(10);

        return Tables\Actions\Action::make('resetPassword')
            ->icon('ri-lock-password-line')
            ->iconButton()
            ->iconSize(IconSize::Large)
            ->requiresConfirmation()
            ->action(function ($record) use ($raw_password) {
                $record->update(['password' => bcrypt($raw_password)]);
            })
            ->after(function ($record) use ($raw_password) {
                // TODO: Send email to the user with the raw password
                // Mail::to($record->email)->send(new UserResetPassword($record, $raw_password));
            })
            ->successNotificationMessage(fn($record) => "The password for user '{$record->name}' has been reset.");
    }
}
