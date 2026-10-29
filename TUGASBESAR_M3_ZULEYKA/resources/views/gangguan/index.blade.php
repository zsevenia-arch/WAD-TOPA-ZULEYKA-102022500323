<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Master Jenis Gangguan IT</title>

    <style>
        * { box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            background: #fce7f3;
            margin: 0;
            padding: 30px;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background: white;
            padding: 36px;
            border-radius: 8px;
        }

        h1 { color: #a0005a; }
        h2 { color: #c00068; }

        hr {
            border: 0;
            border-top: 2px solid #ffc8e4;
            margin: 28px 0;
        }

        .form-box {
            background: #fff0f3;
            padding: 24px;
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ffb3cc;
            border-radius: 5px;
            margin-bottom: 18px;
            font-size: 16px;
            background: white;
        }

        button, .btn {
            border: 0;
            border-radius: 5px;
            padding: 10px 16px;
            color: white;
            background: #e91e4d;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-edit { background: #f0a000; }
        .btn-hapus { background: #dc3545; }
        .btn-batal { background: #777; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 22px;
        }

        th, td {
            border: 1px solid #ffd0e4;
            padding: 12px;
            text-align: center;
        }

        th {
            background: #fff0f3;
            color: #a00035;
        }

        .pesan {
            background: #d1fae5;
            color: #065f46;
            padding: 12px;
            margin-bottom: 18px;
        }

        .error { color: #dc3545; }

        @media (max-width: 700px) {
            body { padding: 10px; }
            .container { padding: 16px; }
        }
    </style>
</head>

<body>
<div class="container">
    <h1>Pengelolaan Master Jenis Gangguan &amp; Prioritas IT</h1>
    <hr>

    <h2>{{ isset($item) ? 'Form Edit Gangguan' : 'Form Tambah Gangguan' }}</h2>

    @if (session('success'))
        <div class="pesan">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="form-box">
        <form action="{{ isset($item) ? url('/gangguan/' . $item->id) : url('/gangguan') }}" method="POST">
            @csrf

            @if (isset($item))
                @method('PUT')
            @endif

            <label for="jenis_gangguan">Jenis Gangguan:</label>
            <input
                type="text"
                id="jenis_gangguan"
                name="jenis_gangguan"
                placeholder="Contoh: Koneksi LAN Putus"
                value="{{ old('jenis_gangguan', $item->jenis_gangguan ?? '') }}"
                required
            >

            <label for="kategori">Kategori:</label>
            <select id="kategori" name="kategori" required>
                <option value="" disabled {{ old('kategori', $item->kategori ?? '') == '' ? 'selected' : '' }}>
                    Pilih Kategori Gangguan
                </option>

                @foreach (['Hardware', 'Software', 'Network'] as $kategori)
                    <option value="{{ $kategori }}" {{ old('kategori', $item->kategori ?? '') == $kategori ? 'selected' : '' }}>
                        {{ $kategori }}
                    </option>
                @endforeach
            </select>

            <label for="tingkat_prioritas">Tingkat Prioritas:</label>
            <select id="tingkat_prioritas" name="tingkat_prioritas" required>
                <option value="" disabled {{ old('tingkat_prioritas', $item->tingkat_prioritas ?? '') == '' ? 'selected' : '' }}>
                    Pilih Tingkat Prioritas
                </option>

                @foreach (['High', 'Medium', 'Low'] as $prioritas)
                    <option value="{{ $prioritas }}" {{ old('tingkat_prioritas', $item->tingkat_prioritas ?? '') == $prioritas ? 'selected' : '' }}>
                        {{ $prioritas }}
                    </option>
                @endforeach
            </select>

            <button type="submit">
                {{ isset($item) ? 'Simpan Perubahan' : 'Simpan' }}
            </button>

            @if (isset($item))
                <a href="{{ url('/gangguan') }}" class="btn btn-batal">Batal</a>
            @endif
        </form>
    </div>

    <hr>

    <h2>Daftar Master Gangguan &amp; Tingkat Prioritas</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Jenis Gangguan</th>
                <th>Kategori</th>
                <th>Tingkat Prioritas</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($gangguan as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->jenis_gangguan }}</td>
                    <td>{{ $data->kategori }}</td>
                    <td>{{ $data->tingkat_prioritas }}</td>
                    <td>
                        <a href="{{ url('/gangguan/' . $data->id . '/edit') }}" class="btn btn-edit">Edit</a>

                        <form action="{{ url('/gangguan/' . $data->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada data gangguan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>