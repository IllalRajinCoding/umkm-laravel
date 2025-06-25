<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UmkmResource\Pages;
use App\Filament\Resources\UmkmResource\RelationManagers;
use App\Models\Umkm;
use App\Models\User;
use App\Models\KategoriUmkm;
use App\Models\Kabkota;
use App\Models\Pembina;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;

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

                        // == TAMBAHKAN INPUT GAMBAR DI SINI ==
                        Forms\Components\FileUpload::make('gambar')
                            ->label('Logo/Gambar UMKM')
                            ->directory('umkm-images') // Simpan di folder storage/app/public/umkm-images
                            ->image()
                            ->imageEditor() // Aktifkan editor gambar sederhana
                            ->maxSize(10240), // Batas ukuran 2MB

                        Forms\Components\Select::make('kategori_umkm_id')
                            ->label('Kategori UMKM')
                            ->options(KategoriUmkm::all()->pluck('nama', 'id'))
                            ->searchable()
                            ->required(),

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
                        Forms\Components\Select::make('pembina_id')
                            ->label('Pembina UMKM')
                            ->options(Pembina::all()->pluck('nama', 'id'))
                            ->searchable()
                            ->nullable(),
                        Forms\Components\Select::make('rating')
                            ->options([
                                1 => '1',
                                2 => '2',
                                3 => '3',
                                4 => '4',
                                5 => '5'
                            ])
                            ->required()
                    ])->columns(2),

                Forms\Components\Section::make('Kontak & Status')
                    ->schema([
                        Forms\Components\TextInput::make('website')
                            ->nullable()
                            ->maxLength(45),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->nullable()
                            ->maxLength(45),

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
                // == TAMBAHKAN KOLOM GAMBAR DI SINI ==
                ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->square(),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama UMKM')
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pemilik')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    }),

                Tables\Columns\TextColumn::make('kategori.nama')
                    ->label('Kategori'),
                Tables\Columns\TextColumn::make('pembina.nama')
                    ->label('Pembina'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('Approve')
                        ->action(function (Umkm $record) {
                            $record->status = 'approved';
                            $record->save();
                            // Kirim notifikasi ke pemilik UMKM
                            Notification::make()
                                ->title('UMKM Anda Telah Disetujui!')
                                ->body('Selamat, UMKM "' . $record->nama . '" telah disetujui dan sekarang tampil untuk publik.')
                                ->success()
                                ->sendToDatabase($record->user);
                        })
                        ->requiresConfirmation()
                        ->color('success')
                        ->icon('heroicon-o-check-badge')
                        ->visible(fn(Umkm $record): bool => $record->status === 'pending'),

                    Tables\Actions\Action::make('Reject')
                        ->action(function (Umkm $record) {
                            $record->status = 'rejected';
                            $record->save();
                            // Kirim notifikasi ke pemilik UMKM
                            Notification::make()
                                ->title('Pendaftaran UMKM Ditolak')
                                ->body('Mohon maaf, pendaftaran UMKM "' . $record->nama . '" ditolak. Silakan periksa kembali data Anda atau hubungi support.')
                                ->danger()
                                ->sendToDatabase($record->user);
                        })
                        ->requiresConfirmation()
                        ->color('danger')
                        ->icon('heroicon-o-x-circle')
                        ->visible(fn(Umkm $record): bool => $record->status === 'pending'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
