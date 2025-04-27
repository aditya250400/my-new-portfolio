<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BiodataResource\Pages;
use App\Filament\Resources\BiodataResource\RelationManagers;
use App\Models\Biodata;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BiodataResource extends Resource
{
    protected static ?string $model = Biodata::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Components\TextInput::make('nim')
                    ->required()
                    ->maxLength(255),

                Components\FileUpload::make('photo')
                    ->image()
                    ->directory('biodata')
                    ->maxSize(2048)
                    ->required(),

                Components\TextInput::make('headline')
                    ->required()
                    ->maxLength(255),
                Components\TextInput::make('about_title')
                    ->required()
                    ->maxLength(255),

                Components\Textarea::make('about_content')
                    ->rows(10)
                    ->cols(20)
                    ->required(),

                Components\TextInput::make('connection_description'),


                Components\TextInput::make('role')
                    ->required()
                    ->maxLength(255),

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('nim'),
                Tables\Columns\ImageColumn::make('photo'),
                Tables\Columns\TextColumn::make('role'),
                Tables\Columns\TextColumn::make('about_title')->limit(10),
                Tables\Columns\TextColumn::make('about_content')->limit(15),
                Tables\Columns\TextColumn::make('headline'),
                Tables\Columns\TextColumn::make('connection_description'),
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
            'index' => Pages\ListBiodatas::route('/'),
            'create' => Pages\CreateBiodata::route('/create'),
            'edit' => Pages\EditBiodata::route('/{record}/edit'),
        ];
    }
}
