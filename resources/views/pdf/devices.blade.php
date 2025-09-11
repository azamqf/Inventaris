<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Export Devices PDF</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background: #eee; }
        tfoot td { font-weight: bold; }
    </style>
</head>
<body>
    <h2>Daftar Device</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Serial Number</th>
                <th>Jenis Perangkat</th>
                <th>Kondisi</th>
                <th>Member</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($devices as $i => $device)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $device->name }}</td>
                <td>{{ $device->serial_number }}</td>
                <td>{{ optional($device->deviceType)->name }}</td>
                <td>{{ optional($device->condition)->name }}</td>
                <td>{{ optional($device->member)->name }}</td>
                <td>{{ $device->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7">Total: {{ count($devices) }} device</td>
            </tr>
        </tfoot>
    </table>
    <div style="text-align:right;">Exported: {{ now()->format('d-m-Y H:i') }}</div>
</body>
</html>
