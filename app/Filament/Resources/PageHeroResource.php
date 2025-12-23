<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageHeroResource\Pages;
use App\Models\PageHero;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PageHeroResource extends Resource
{
    protected static ?string $model = PageHero::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-photo';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Content';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Schemas\Components\Section::make('Page Hero Details')
                    ->schema([
                        Forms\Components\Select::make('page_slug')
                            ->required()
                            ->options([
                                'about' => 'About Us',
                                'projects' => 'Projects',
                                'testimonials' => 'Testimonials',
                                'partnerships' => 'Partnerships',
                                'gallery' => 'Gallery',
                                'blog' => 'Blog',
                            ])
                            ->unique(ignoreRecord: true),
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->required()
                            ->disk('public')
                            ->directory('page-heroes')
                            ->columnSpanFull()
                            ->helperText('Recommended size: 1920x400px or similar wide format'),
                        Forms\Components\RichEditor::make('overlay_text')
                            ->required()
                            ->columnSpanFull()
                    ])
                    ->columnSpanFull(),
                    
                Schemas\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->default(true)
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->circular()
                    ->size(60),
                Tables\Columns\TextColumn::make('page_slug')
                    ->searchable()
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('overlay_text')
                    ->limit(50),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('page_slug');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPageHeroes::route('/'),
            'create' => Pages\CreatePageHero::route('/create'),
            'edit' => Pages\EditPageHero::route('/{record}/edit'),
        ];
    }
}

