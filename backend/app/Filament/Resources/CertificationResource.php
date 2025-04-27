<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CertificationResource\Pages;
use App\Filament\Resources\CertificationResource\RelationManagers;
use App\Models\Certification;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CertificationResource extends Resource
{
    protected static ?string $model = Certification::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Components\Textarea::make('description')
                    ->rows(10)
                    ->cols(20),

                Components\FileUpload::make('thumbnail')
                    ->image()
                    ->directory('certifications')
                    ->maxSize(3072)
                    ->required(),

                Components\TextInput::make('company_name')
                    ->required(),

                Components\TextInput::make('credential'),

                Components\TextInput::make('credential_link'),

                Components\DatePicker::make('start_date')
                    ->required(),

                Components\DatePicker::make('end_date'),

                Components\Radio::make('is_featured')
                    ->label('Is Featrued?')
                    ->boolean()->required(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('company_name'),
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('description')->limit(10),
                Tables\Columns\TextColumn::make('credential'),
                Tables\Columns\TextColumn::make('credential_link'),
                Tables\Columns\TextColumn::make('start_date'),
                Tables\Columns\TextColumn::make('end_date'),
                IconColumn::make('is_featured')
                    ->boolean(),
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
            'index' => Pages\ListCertifications::route('/'),
            'create' => Pages\CreateCertification::route('/create'),
            'edit' => Pages\EditCertification::route('/{record}/edit'),
        ];
    }
}
