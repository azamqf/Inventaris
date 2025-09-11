<?php

namespace App\Filament\Resources\MemberResource\Actions;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Support\Facade\Date;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExportMemberPdfAction
{
    public static function makeBulk(): BulkAction
    {
        return BulkAction::make('export_pdf')
            ->label('Export PDF')
            ->icon('heroicon-o-document')
            ->action(function ($records) {
                $date = now()->format('Y-m-d');
                $filename = 'members-' . $date . '.pdf';
                $pdf = Pdf::loadView('pdf.members', [
                    'members' => $records,
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
                $filename = 'member-' . $record->id . '-' . $date . '.pdf';
                $pdf = Pdf::loadView('pdf.members', [
                    'members' => [$record],
                ]);
                return response()->streamDownload(function () use ($pdf) {
                    echo $pdf->output();
                }, $filename);
            });
    }
}
