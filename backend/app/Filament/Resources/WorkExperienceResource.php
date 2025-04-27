<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkExperienceResource\Pages;
use App\Filament\Resources\WorkExperienceResource\RelationManagers;
use App\Models\WorkExperience;
use Filament\Forms\Form;
use Filament\Forms\Components;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkExperienceResource extends Resource
{
    protected static ?string $model = WorkExperience::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Components\TextInput::make('role')
                    ->required()
                    ->maxLength(255),



                Components\Textarea::make('description')
                    ->rows(10)
                    ->cols(20),

                Components\FileUpload::make('thumbnail')
                    ->image()
                    ->directory('work_experiences')
                    ->maxSize(2048)
                    ->required(),


                Components\DatePicker::make('start_date')
                    ->required(),

                Components\DatePicker::make('end_date'),

                Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255),



            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('role'),
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('description')->limit(10),
                Tables\Columns\TextColumn::make('start_date'),
                Tables\Columns\TextColumn::make('end_date'),
                Tables\Columns\TextColumn::make('location'),
                Tables\Columns\TextColumn::make('slug'),
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
            'index' => Pages\ListWorkExperiences::route('/'),
            'create' => Pages\CreateWorkExperience::route('/create'),
            'edit' => Pages\EditWorkExperience::route('/{record}/edit'),
        ];
    }
}
