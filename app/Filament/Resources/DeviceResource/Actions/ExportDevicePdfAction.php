<?php

namespace App\Filament\Resources\DeviceResource\Actions;

use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportDevicePdfAction
{
    public static function makeBulk(): BulkAction
    {
        return BulkAction::make('export_pdf')
            ->label('Export PDF')
            ->icon('heroicon-o-document')
            ->action(function ($records) {
                $date = now()->format('Y-m-d');
                $filename = 'devices-' . $date . '.pdf';
                $pdf = Pdf::loadView('pdf.devices', [
                    'devices' => $records,
                ]);
                return response()->streamDownload(function () use ($pdf) {
                    echo $pdf->output();
                }, $filename);
            });
    }

    public static function makeSingle(): Action
    {
        return Action::make('export_pdf')
            ->label('Export PDF')
            ->icon('heroicon-o-document')
            ->action(function ($record) {
                $date = now()->format('Y-m-d');
                $filename = 'device-' . $record->id . '-' . $date . '.pdf';
                $pdf = Pdf::loadView('pdf.devices', [
                    'devices' => [$record],
                ]);
                return response()->streamDownload(function () use ($pdf) {
                    echo $pdf->output();
                }, $filename);
            });
    }
}
