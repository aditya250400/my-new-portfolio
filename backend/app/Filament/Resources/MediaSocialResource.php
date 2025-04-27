<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaSocialResource\Pages;
use App\Filament\Resources\MediaSocialResource\RelationManagers;
use App\Models\MediaSocial;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MediaSocialResource extends Resource
{
    protected static ?string $model = MediaSocial::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Components\TextInput::make('link')
                    ->maxLength(255)->required(),

                Components\FileUpload::make('icon')
                    ->image()
                    ->directory('media_socials')
                    ->maxSize(3072),

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('link'),
                Tables\Columns\ImageColumn::make('icon'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListMediaSocials::route('/'),
            'create' => Pages\CreateMediaSocial::route('/create'),
            'edit' => Pages\EditMediaSocial::route('/{record}/edit'),
        ];
    }
}
