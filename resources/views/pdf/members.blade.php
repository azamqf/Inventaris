<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Export Members PDF</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background: #eee; }
        tfoot td { font-weight: bold; }
    </style>
</head>
<body>
    <h2>Daftar Anggota</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Email</th>
                <th>Tanggal Bergabung</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $i => $member)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->gender }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">Total: {{ count($members) }} anggota</td>
            </tr>
        </tfoot>
    </table>
    <div style="text-align:right;">Exported: {{ now()->format('d-m-Y H:i') }}</div>
</body>
</html>
