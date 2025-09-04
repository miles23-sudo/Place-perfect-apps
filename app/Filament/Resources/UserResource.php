<?php

namespace App\Filament\Resources;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\Enums\IconSize;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms;
use App\Models\User;
use App\Mail\User\ResetPasswordMail;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\Pages;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'phosphor-users-duotone';

    protected static ?string $navigationGroup = 'Administration';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->hintIcon('phosphor-info-duotone')
                    ->hintIconTooltip('Upon account creation, an email containing the account details will be sent to the provided address.')
                    ->required()
                    ->string()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
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
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Access')
                    ->onIcon('phosphor-check-circle-duotone')
                    ->offIcon('phosphor-x-circle-duotone'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('M d, Y h:i A')
            ])
            ->actions([
                ActionGroup::make([
                    self::getEditAction(),
                    self::getPasswordResetAction(),
                ])
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
            ->successNotificationMessage(fn($record) => "The user '{$record->name}' has been updated.")
            ->modalWidth(MaxWidth::Large)
            ->closeModalByClickingAway(false);
    }

    // Reset Password Action
    public static function getPasswordResetAction(): Tables\Actions\Action
    {
        $raw_password = Str::random(10);

        return Tables\Actions\Action::make('resetPassword')
            ->icon('phosphor-lock-key-duotone')
            ->requiresConfirmation()
            ->action(function ($record) use ($raw_password) {
                $record->update(['password' => bcrypt($raw_password)]);
            })
            ->after(function ($record) use ($raw_password) {
                Mail::to($record->email)->send(new ResetPasswordMail($record, $raw_password));
            })
            ->successNotificationMessage(fn($record) => "The password for user '{$record->name}' has been reset.");
    }
}
