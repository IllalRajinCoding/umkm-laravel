<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UmkmResource\Pages;
use App\Filament\Resources\UmkmResource\RelationManagers;
use App\Models\Umkm;
use App\Models\User;
use App\Models\KategoriUmkm;
use App\Models\Kabkota;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class UmkmResource extends Resource
{
    protected static ?string $model = Umkm::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationLabel = 'Manajemen UMKM';
    protected static ?string $pluralModelLabel = 'UMKM';

    protected static ?string $modelLabel = 'UMKM';
    protected static ?string $navigationGroup = 'Manajemen UMKM';
    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Mengelompokkan field dalam sebuah Card untuk tampilan yang lebih rapi
                Forms\Components\Section::make('Informasi Dasar UMKM')
                    ->description('Isi data utama terkait UMKM yang didaftarkan.')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Pemilik UMKM')
                            ->options(User::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),

                        Forms\Components\TextInput::make('nama')
                            ->label('Nama UMKM')
                            ->required()
                            ->maxLength(100),

                        // Dropdown untuk Kategori, mengambil dari tabel relasi
                        Forms\Components\Select::make('kategori_umkm_id')
                            ->label('Kategori UMKM')
                            ->options(KategoriUmkm::all()->pluck('nama', 'id'))
                            ->searchable()
                            ->required(),


                        // Dropdown untuk Kabupaten/Kota
                        Forms\Components\Select::make('kabkota_id')
                            ->label('Kabupaten/Kota')
                            ->options(Kabkota::all()->pluck('nama', 'id'))
                            ->searchable()
                            ->required(),

                        Forms\Components\Textarea::make('alamat')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('modal')
                            ->numeric()
                            ->prefix('Rp'),

                        Forms\Components\Select::make('rating')
                            ->options([
                                1 => '1',
                                2 => '2',
                                3 => '3',
                                4 => '4',
                                5 => '5'
                            ])
                            ->required()
                    ])->columns(2), // Membuat layout form menjadi 2 kolom

                Forms\Components\Section::make('Kontak & Status')
                    ->schema([
                        Forms\Components\TextInput::make('website')
                            ->nullable()
                            ->maxLength(45),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->nullable()
                            ->maxLength(45),

                        // Dropdown untuk mengatur status UMKM
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom untuk menampilkan nama UMKM, bisa dicari
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama UMKM')
                    ->searchable(),

                // Menampilkan nama pemilik dari relasi User
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pemilik')
                    ->sortable(),

                // Menampilkan status dengan badge berwarna agar mudah dilihat
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ]),

                // Menampilkan kategori dari relasi
                Tables\Columns\TextColumn::make('kategori.nama')
                    ->label('Kategori'),
            ])
            ->filters([
                // Filter berdasarkan status untuk memudahkan admin
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
                // Grup Aksi untuk setiap baris data
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    // Aksi untuk menyetujui UMKM
                    Tables\Actions\Action::make('Approve')
                        ->action(function (Umkm $record) {
                            $record->status = 'approved';
                            $record->save();
                        })
                        ->requiresConfirmation()
                        ->color('success')
                        ->icon('heroicon-o-check-badge')
                        // Aksi ini hanya akan muncul jika status UMKM adalah 'pending'
                        ->visible(fn(Umkm $record): bool => $record->status === 'pending'),

                    // Aksi untuk menolak UMKM
                    Tables\Actions\Action::make('Reject')
                        ->action(function (Umkm $record) {
                            $record->status = 'rejected';
                            $record->save();
                        })
                        ->requiresConfirmation()
                        ->color('danger')
                        ->icon('heroicon-o-x-circle')
                        // Aksi ini hanya akan muncul jika status UMKM adalah 'pending'
                        ->visible(fn(Umkm $record): bool => $record->status === 'pending'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    // Aksi massal untuk menyetujui beberapa UMKM sekaligus
                    Tables\Actions\BulkAction::make('approve_selected')
                        ->label('Approve Selected')
                        ->icon('heroicon-o-check-badge')
                        ->color('success')
                        ->action(fn(Collection $records) => $records->each->update(['status' => 'approved']))
                        ->requiresConfirmation(),
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
            'index' => Pages\ListUmkms::route('/'),
            'create' => Pages\CreateUmkm::route('/create'),
            'edit' => Pages\EditUmkm::route('/{record}/edit'),
        ];
    }
}
