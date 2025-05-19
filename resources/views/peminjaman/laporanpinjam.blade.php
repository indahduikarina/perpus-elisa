<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Laporan Peminjaman</title>
  <style>
    /* Container & Reset */
    body { margin:0; padding:20px; font-family: Arial, sans-serif; background: #FFF0F6; }
    h2 { text-align: center; color: #AD1457; margin-bottom: 20px; }

    /* Responsive wrapper */
    .table-wrapper { overflow-x: auto; }

    /* Table styling */
    table {
      width: 100%;
      border-collapse: collapse;
      background: #FFFFFF;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      border-radius: 8px;
      overflow: hidden;
    }
    thead {
      background: #FCE4EC;
    }
    thead th {
      padding: 12px;
      color: #880E4F;
      font-weight: bold;
      text-align: left;
      font-size: 14px;
      border-bottom: 1px solid #F8BBD0;
    }
    tbody td {
      padding: 10px;
      color: #AD1457;
      font-size: 13px;
      border-bottom: 1px solid #F8BBD0;
    }
    tbody tr:hover td {
      background: #FFF1F3;
    }

    /* Small screens */
    @media (max-width: 600px) {
      thead { display: none; }
      table, tbody, tr, td { display: block; width: 100%; }
      tr { margin-bottom: 15px; }
      td {
        padding-left: 50%;
        position: relative;
      }
      td::before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        font-weight: bold;
        color: #880E4F;
      }
    }
  </style>
</head>
<body>
  <h2>LAPORAN DATA PEMINJAMAN</h2>

  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Anggota</th>
          <th>Buku</th>
          <th>Tgl Pinjam</th>
          <th>Tgl Kembali</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $i => $row)
        <tr>
          <td data-label="No">{{ $i + 1 }}</td>
          <td data-label="Anggota">{{ $row->anggota->nama }}</td>
          <td data-label="Buku">{{ $row->buku->judulbuku }}</td>
          <td data-label="Tgl Pinjam">{{ \Carbon\Carbon::parse($row->tglpinjam)->format('d-m-Y') }}</td>
          <td data-label="Tgl Kembali">{{ \Carbon\Carbon::parse($row->tglkembali)->format('d-m-Y') }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>
