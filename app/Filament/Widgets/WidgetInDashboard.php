<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Umkm;
use App\Models\User;
use Carbon\Carbon;

class WidgetInDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        // Menghitung jumlah UMKM yang menunggu persetujuan.
        $pendingUmkmCount = Umkm::where('status', 'pending')->count();

        // Menghitung jumlah UMKM baru yang terdaftar bulan ini menggunakan timestamp.
        $newUmkmThisMonth = Umkm::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        return [
            Stat::make('Total UMKM Terdaftar', Umkm::count())
                ->description('Semua UMKM yang ada di sistem')
                ->descriptionIcon('heroicon-m-building-storefront')
                ->color('primary'),

            // Stat #2: UMKM yang perlu disetujui
            Stat::make('Menunggu Persetujuan', $pendingUmkmCount)
                ->description('UMKM baru yang perlu ditinjau')
                ->descriptionIcon('heroicon-m-clock')
                ->color($pendingUmkmCount > 0 ? 'danger' : 'success'),

            // Stat #3: UMKM baru bulan ini (memanfaatkan timestamp)
            Stat::make('Pendaftar Bulan Ini', $newUmkmThisMonth)
                ->description('Jumlah UMKM baru yang mendaftar bulan ini')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning'),

            // Stat #4: Total Pengguna (User) yang terdaftar
            Stat::make('Total Pengguna', User::where('role', 'user')->count())
                ->description('Jumlah pemilik UMKM yang terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),
        ];
    }
}
