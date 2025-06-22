<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembinaResource\Pages;
use App\Filament\Resources\PembinaResource\RelationManagers;
use App\Models\Pembina;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PembinaResource extends Resource
{
    protected static ?string $model = Pembina::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Manajemen UMKM';
    protected static ?string $navigationLabel = 'Pelatihan UMKM';
    protected static ?string $pluralModelLabel = 'Pelatihan UMKM';
    protected static ?string $modelLabel = 'Pelatihan UMKM';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('gender')
                    ->maxLength(1)
                    ->default(null),
                Forms\Components\DatePicker::make('tgl_lahir'),
                Forms\Components\TextInput::make('tmp_lahir')
                    ->maxLength(30)
                    ->default(null),
                Forms\Components\TextInput::make('keahlian')
                    ->maxLength(200)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tgl_lahir')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tmp_lahir')
                    ->searchable(),
                Tables\Columns\TextColumn::make('keahlian')
                    ->searchable(),
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
            'index' => Pages\ListPembinas::route('/'),
            'create' => Pages\CreatePembina::route('/create'),
            'edit' => Pages\EditPembina::route('/{record}/edit'),
        ];
    }
}
