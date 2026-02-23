<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-cog-6-tooth';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Administration';
    }

    public static function getNavigationLabel(): string
    {
        return 'Site Settings';
    }

    public static function getNavigationSort(): ?int
    {
        return 10;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Schemas\Components\Section::make('Get In Touch')
                ->description('This information appears in the footer "Get In Touch" column.')
                ->schema([
                    Forms\Components\Textarea::make('address')
                        ->label('Address')
                        ->rows(2)
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('email')
                        ->label('Email Address')
                        ->email(),
                    Forms\Components\TextInput::make('business_hours')
                        ->label('Business Hours')
                        ->placeholder('Monday - Friday, 08am - 05pm'),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Schemas\Components\Section::make('Social Media Links')
                ->description('Leave blank to hide the icon in the footer.')
                ->schema([
                    Forms\Components\TextInput::make('instagram_url')
                        ->label('Instagram URL')
                        ->url()
                        ->prefix('fab fa-instagram'),
                    Forms\Components\TextInput::make('twitter_url')
                        ->label('X (Twitter) URL')
                        ->url(),
                    Forms\Components\TextInput::make('linkedin_url')
                        ->label('LinkedIn URL')
                        ->url(),
                    Forms\Components\TextInput::make('tiktok_url')
                        ->label('TikTok URL')
                        ->url(),
                    Forms\Components\TextInput::make('facebook_url')
                        ->label('Facebook URL')
                        ->url(),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('address')
                    ->label('Address')
                    ->limit(50),
                Tables\Columns\TextColumn::make('business_hours')
                    ->label('Hours'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->actions([
                Actions\EditAction::make()->label('Edit Settings'),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteSettings::route('/'),
            'edit'  => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
