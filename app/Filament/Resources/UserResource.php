<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-users';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Administration';
    }

    public static function getNavigationLabel(): string
    {
        return 'Users';
    }

    public static function getNavigationSort(): ?int
    {
        return 1;
    }

    /** Only administrators may access this resource. */
    public static function canAccess(): bool
    {
        return Auth::check() && Auth::user()->isAdmin();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Schemas\Components\Section::make('Account Details')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255)
                        ->unique(User::class, 'email', ignoreRecord: true),

                    Forms\Components\Select::make('role')
                        ->required()
                        ->options(User::ROLES)
                        ->default('editor')
                        ->helperText('Administrators have full access. Editors can manage content but cannot manage users.')
                        ->disabled(fn ($record) => $record?->id === Auth::id()),

                    Forms\Components\Toggle::make('email_verified_at')
                        ->label('Email Verified')
                        ->helperText('Mark this account as having a verified email address.')
                        ->onIcon('heroicon-m-check-badge')
                        ->offIcon('heroicon-m-x-circle')
                        ->dehydrateStateUsing(fn ($state) => $state ? now() : null)
                        ->afterStateHydrated(fn ($component, $record) => $component->state((bool) $record?->email_verified_at)),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Schemas\Components\Section::make('Password')
                ->description(fn (string $context) => $context === 'edit'
                    ? 'Leave blank to keep the current password.'
                    : 'Set a strong password for this account.')
                ->schema([
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->revealable()
                        ->minLength(8)
                        ->maxLength(255)
                        ->required(fn (string $context) => $context === 'create')
                        ->dehydrated(fn ($state) => filled($state))
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->confirmed()
                        ->helperText('Minimum 8 characters.'),

                    Forms\Components\TextInput::make('password_confirmation')
                        ->password()
                        ->revealable()
                        ->maxLength(255)
                        ->required(fn (string $context) => $context === 'create')
                        ->dehydrated(false)
                        ->label('Confirm Password'),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('role')
                    ->colors([
                        'danger'  => 'admin',
                        'info'    => 'editor',
                    ])
                    ->formatStateUsing(fn ($state) => User::ROLES[$state] ?? ucfirst($state)),

                Tables\Columns\IconColumn::make('email_verified_at')
                    ->label('Verified')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-clock'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Joined')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options(User::ROLES),
                Tables\Filters\TernaryFilter::make('email_verified_at')
                    ->label('Email Verified')
                    ->nullable(),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\Action::make('verify_email')
                    ->label('Verify Email')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->visible(fn (User $record) => ! $record->email_verified_at)
                    ->action(function (User $record) {
                        $record->update(['email_verified_at' => now()]);
                        Notification::make()->title('Email marked as verified.')->success()->send();
                    }),
                Actions\DeleteAction::make()
                    ->visible(fn (User $record) => self::canDeleteRecord($record))
                    ->before(function (User $record, Actions\DeleteAction $action) {
                        if (! self::canDeleteRecord($record)) {
                            Notification::make()
                                ->title('Cannot delete this user.')
                                ->body($record->id === Auth::id()
                                    ? 'You cannot delete your own account.'
                                    : 'You cannot remove the last administrator.')
                                ->danger()
                                ->send();
                            $action->cancel();
                        }
                    }),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make()
                        ->before(function ($records, Actions\DeleteBulkAction $action) {
                            foreach ($records as $record) {
                                if (! self::canDeleteRecord($record)) {
                                    Notification::make()
                                        ->title('Some users could not be deleted.')
                                        ->body('You cannot delete yourself or the last administrator.')
                                        ->warning()
                                        ->send();
                                    $action->cancel();
                                    return;
                                }
                            }
                        }),
                ]),
            ]);
    }

    /** Shared delete guard: cannot delete yourself or the last admin. */
    public static function canDeleteRecord(User $record): bool
    {
        if ($record->id === Auth::id()) {
            return false;
        }

        if ($record->role === 'admin' && User::where('role', 'admin')->count() <= 1) {
            return false;
        }

        return true;
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
