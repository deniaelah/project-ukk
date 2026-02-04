<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengembalian</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; font-size: 12px; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Pengembalian Alat</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Alat</th>
                <th>Tgl Kembali</th>
                <th>Jumlah</th>
                <th>Kondisi</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengembalians as $index => $pengembalian)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pengembalian->peminjaman->user->name ?? 'N/A' }}</td>
                <td>{{ $pengembalian->peminjaman->alat->nama_alat ?? 'N/A' }}</td>
                <td>{{ $pengembalian->tanggal_kembali }}</td>
                <td>{{ $pengembalian->jumlah_kembali }}</td>
                <td>{{ ucfirst($pengembalian->kondisi_kembali) }}</td>
                <td>{{ ucfirst($pengembalian->status_pengembalian) }}</td>
                <td>Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
