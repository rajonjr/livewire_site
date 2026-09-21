<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Booking;
use App\Models\Desk;
use App\Models\Invoice;
use App\Models\Subscription;
use Illuminate\Support\Carbon;

class CoworkingStatsOverview extends StatsOverviewWidget
{
    // Permet de rafraîchir les stats automatiquement toutes les 10 secondes (optionnel)
    protected ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        // Calcul du Chiffre d'Affaires total des factures payées
        $totalRevenue = Invoice::where('status', 'paid')->sum('amount');
        $lastMonthRevenue = Invoice::where('status', 'paid')
            ->whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])
            ->sum('amount');

        // Nombre total de réservations avec tendance sur les 7 derniers jours
        $totalBookings = Booking::count();
        $bookingsChart = $this->getTrendData(Booking::class);

        // Abonnements actifs
        $activeSubscriptions = Subscription::where('status', 'active')->count();

        // Taux d'occupation des bureaux
        $totalDesks = Desk::count();
        $activeDesks = Desk::where('is_active', true)->count();
        $occupancyRate = $totalDesks > 0 ? round(($activeDesks / $totalDesks) * 100) : 0;

        return [
            Stat::make('Chiffre d\'Affaires Total', number_format($totalRevenue, 2, ',', ' ') . ' €')
                ->description('Revenus encaissés')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 12, 10, 18, 15, 22, $totalRevenue > 0 ? 30 : 0]),

            Stat::make('Réservations Totales', $totalBookings)
                ->description('Activité globale des bureaux')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary')
                ->chart($bookingsChart),

            Stat::make('Abonnements Actifs', $activeSubscriptions)
                ->description('Membres abonnés en cours')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make('Bureaux Actifs', "{$activeDesks} / {$totalDesks}")
                ->description("Taux de disponibilité des postes")
                ->descriptionIcon('heroicon-m-computer-desktop')
                ->color($occupancyRate > 50 ? 'success' : 'danger'),
        ];
    }

    /**
     * Méthode utilitaire pour générer un petit tableau de tendance pour les graphiques
     */
    private function getTrendData(string $modelClass): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $data[] = $modelClass::whereDate('created_at', $date->format('Y-m-d'))->count();
        }
        return $data;
    }
}
