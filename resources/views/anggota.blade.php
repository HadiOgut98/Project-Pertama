<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    
    <title>CRUD LARAVEL8</title>
  </head>
  <body>

    <h1 class="text-center mb-4">Data Anggota!</h1>

    <div class="container">
        <a href="/tambah_data" class="btn btn-primary btn-sm">Tambah Data</a>
        <div class="row g-3 align-items-center mt-2">
          <div class="col-auto">
            <form action="/anggota" method="GET">
              <input type="search" id="inputSearch" name="search" class="form-control">
            </form>
          </div>
          <div class="col-auto">
            <a href="/export_pdf" class="btn btn-info btn-sm">Export PDF</a>
          </div>
          <div class="col-auto">
            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#import-data">
              Import Data
            </button>
          </div>
        </div>
          <!-- Modal -->
          <div class="modal fade" id="import-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Import Data </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                    <div class="form-group">
                      <input type="file" name="file" required>
                    </div>
                  </div>
                
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Import</button>
                </div>
                </form>
              </div>
            </div>
          </div>

        <div class="row">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">No Telp</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Dibuat</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $no => $row)
                  <tr>
                    <th scope="row"> {{ $no + $data->firstitem() }}</th>
                    <td>
                        <img class="img rounded-circle" src="{{ ('foto_anggota/'.$row->foto) }}" alt="" style="width: 40px">
                    </td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->jenis_kelamin }}</td>
                    <td>{{ $row->no_telp }}</td>
                    <td>{{ $row->alamat }}</td>
                    <td>{{ $row->created_at->format('D N Y') }}</td>
                    <td>
                        <a href="/tampil_data/{{ $row->id }}" class="btn btn-success btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm delete" data-id="{{ $row->id }}">Hapus</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>
    

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

    {{-- SweetAlert --}}
    <script src="template/sweetalert/jquery.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="template/sweetalert/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  </body>
    <script>
      $('.delete').click( function(){
        var anggota_id = $(this).attr('data-id');
        swal({
          title: "Yakin?",
          text: "Anda akan menghapus data anggota ini?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location = "/delete/"+anggota_id+""
            swal("Successfully! Data berhasil dihapus!", {
              icon: "success",
            });
          } else {
            swal("OK! data tidak anda hapus!");
          }
        });
      });
  </script>

  {{-- Toastr --}}
  <script>
    @if (Session::has('success'))
      toastr.success("{{ Session::get('success') }}")
    @endif
  </script>

</html>