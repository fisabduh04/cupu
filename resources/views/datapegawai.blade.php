<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
   
   
    <title>Data Pegawai</title>
  </head>
  <body>
    <h1 class="text-center mb-4">Data Pegawai</h1>    
    <div class="container">
      <a href="/tambahpegawai" class="btn btn-success mb-2">Tambah +</a>
      @if ($message=Session::get('success'))
      <div class="alert alert-success" role="alert">
        {{$message}}
      </div>
      @endif
      {{-- pencarian --}}
      <div class="row g-3 align-items-center">
        <div class="col-auto">
          <label for="inputPassword6" class="col-form-label">Search</label>
        </div>
        <div class="col-auto">
          <form action="/pegawai" method="GET">
            <input type="search" name="search" id="inputPassword6" class="form-control" placeholder="Ketik Disini" aria-describedby="passwordHelpInline">
          </form>
        </div>

        <div class="col-auto">
            <a href="/exportpdf" class="btn btn-info mb-2">Eksport PDF</a>          
        </div>

        <div class="col-auto">
          <a href="#" class="btn btn-primary mb-2">Eksport Excel</a>          
      </div>

      </div>

      <div class="row">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Foto</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">No Telepon</th>
            <th scope="col">Dibuat</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $row)              
          <tr>
            <th scope="row">{{$row->id}}</th>
            <td>{{$row->nama}}</td>
            <td>
              <img src="{{asset('fotopegawai/'.$row->foto)}}" alt="" width="50px">              
            </td>
            <td>{{$row->jeniskelamin}}</td>
            <td>{{$row->notelpon}}</td>
            <td>{{$row->created_at->format('D - M - Y')}}</td>
            <td>
              {{-- <form action="hapusdata/{{$row->id}}" method="Post"> --}}
                {{-- @csrf --}}
                {{-- <button class="btn btn-danger">Delete</button> --}}
                <a href="#" class="btn btn-danger delete" data-id="{{$row->id}}">Delete</a>
              {{-- </form> --}}
               <a href="/tampilkandata/{{$row->id}}" class="btn btn-info">Edit</a>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
    <script>
      $('.delete').click(function(){
        var pegawaiid=$(this).attr('data-id')
        swal({
          title: "Yakin?",
          text: "Kamu akan menghapus data oegawai dengan id : "+pegawaiid+"!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location="/hapusdata/"+pegawaiid+""
            swal("Data Berhasil Dihapus", {
              icon: "success",
            });
          } else {
            swal("Data tidak jadi dihapus");
          }
        });


      })
    </script>
  </html>