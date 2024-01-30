<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Customer</title>
    
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">


    <!-- Date Picker -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker3.css') }}">
    

</head>
<body>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Customer</h1>
    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-body">
                <a href="" data-toggle="modal" data-target="#addModal" class="btn btn-md btn-success mb-3">TAMBAH CUSTOMER</a>
                <table id="datatable" class="table">
                    <thead>
                    <tr>
                        <th>NAMA CUSTOMER</th>
                        <th>TANGGAL MULAI SEWA</th>
                        <th>TANGGAL SELESAI SEWA</th>
                        <th>HARGA SEWA</th>
                        <th>NO KENDARAAN</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($customer as $value)
                        <tr>
                            <td>{{ $value->nama_customer }}</td>
                            <td>{{ $value->tanggal_mulai_sewa }}</td>
                            <td>{{ $value->tanggal_selesai_sewa }}</td>
                            <td>{{ $value->harga_sewa }}</td>                            
                            <td>{{ $value->no_plat }}</td>
                            <td>{{ $value->created_at }}</td>
                            <td>
                                <a href="#editModal{{ $value->id }}" data-toggle="modal" class="btn btn-sm btn-primary mb-1"><i class="fas fa-edit fa-sm"></i> Update</a>
                                <a href="#deleteModal{{ $value->id }}" data-toggle="modal" class="btn btn-danger btn-sm"><i class="fas fa-trash fa-sm" style="padding:0 2px"> Delete</i></a>
                            </td>
                        </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Barang belum Tersedia.
                            </div>
                                    
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
           
     <!-- modal add start-->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalTitle">TAMBAH BARU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('customer.store') }}" method="POST">
                                
                    @csrf

                    <div class="form-group">
                        <label class="font-weight-bold">NAMA CUSTOMER</label>
                        <!-- error message untuk title -->
                        @error('nama_barang')
                            <div style="color:#820000; font-weight:300px">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="text" class="form-control @error('nama_customer') is-invalid @enderror" name="nama_customer" value="{{ old('nama_customer') }}" placeholder="Masukkan Nama Customer">
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">TANGGAL MULAI SEWA</label>
                        <!-- error message untuk title -->
                        @error('tanggal_mulai_sewa')
                            <div style="color:#820000; font-weight:300px">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="date" class="form-control @error('tanggal_mulai_sewa') is-invalid @enderror" name="tanggal_mulai_sewa" value="{{ old('tanggal_mulai_sewa') }}" placeholder="Select Date">
                        
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">TANGGAL SELESAI SEWA</label>
                        <!-- error message untuk title -->
                        @error('tanggal_selesai_sewa')
                            <div style="color:#820000; font-weight:300px">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="date" class="form-control @error('tanggal_selesai_sewa') is-invalid @enderror" name="tanggal_selesai_sewa" value="{{ old('tanggal_selesai_sewa') }}" placeholder="Select Date">
                         
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">HARGA SEWA</label>
                        
                        <input type="number" class="form-control @error('harga_sewa') is-invalid @enderror" name="harga_sewa" value="{{ old('harga_sewa') }}" >
                    
                        <!-- error message untuk title -->
                        @error('harga_sewa')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>       
                    
                    <div class="form-group">
                        <label class="font-weight-bold">NO KENDARAAN</label>
                        <select name="no_kendaraan" class="form-control @error('nama_barang') is-invalid @enderror">
                            <option disabled selected>--Pilih No Kendaraan--</options>
                            @foreach($no_plat as $value )
                                <option value="{{ $value->id }}">
                                    {{ $value->no_plat }}
                                </option>
                            @endforeach
                        </select>
                        
                        <!-- error message untuk title -->
                        @error('no_kendaraan')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="submit" class="btn btn-primary">SIMPAN</button>
            </div>
            </form>
            </div>
        </div>
    </div>
    <!-- modal add end -->

    <!-- modal edit start-->
    @foreach($customer as $value)
    <div class="modal fade" id="editModal{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="addModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('customer.update', $value->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalTitle">EDIT DATA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Customer</label>
                            <input type="text" class="form-control @error('nama_customer') is-invalid @enderror" name="nama_customer" value="{{ $value->nama_customer }}" placeholder="Masukkan Nama Customer">
                            <!-- error message untuk title -->
                            @error('nama_customer')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>    
                        
                        <div class="form-group">
                            <label class="font-weight-bold">TANGGAL MULAI SEWA</label>
                            <input type="date" class="form-control @error('tanggal_mulai_sewa') is-invalid @enderror"  name="tanggal_mulai_sewa" value="{{ $value->tanggal_mulai_sewa }}" placeholder="Select Date">
                             <!-- error message untuk title -->
                             @error('tanggal_mulai_sewa')
                                <div style="color:#820000; font-weight:300px">
                                    {{ $message }}
                                </div>
                            @enderror
                           
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">TANGGAL SELESAI SEWA</label>
                            <input type="date" class="form-control @error('tanggal_selesai_sewa') is-invalid @enderror" name="tanggal_selesai_sewa" value="{{ $value->tanggal_selesai_sewa }}" placeholder="Select Date">
                            <!-- error message untuk title -->
                            @error('tanggal_selesai_sewa')
                                <div style="color:#820000; font-weight:300px">
                                    {{ $message }}
                                </div>
                            @enderror
                          
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">HARGA SEWA</label>
                            
                            <input type="number" class="form-control @error('harga_sewa') is-invalid @enderror" name="harga_sewa" value="{{ $value->harga_sewa }}" >
                        
                            <!-- error message untuk title -->
                            @error('harga_sewa')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>       
                        
                        <div class="form-group">
                            <label class="font-weight-bold">NO KENDARAAN</label>
                            <select name="no_kendaraan" class="form-control @error('nama_barang') is-invalid @enderror">
                                @foreach($no_plat as $item )
                                    <option value="{{ $value->id }}" {{ ($value->id == $item->id) ? 'selected' : '' }}>
                                        {{ $item->no_plat }}
                                    </option>
                                @endforeach
                            </select>
                            
                            <!-- error message untuk title -->
                            @error('no_kendaraan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>  
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach
    <!-- modal edit end -->

    <!-- modal delete start-->
    @foreach($customer as $value)
    <div class="modal fade" id="deleteModal{{$value->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('customer.destroy', $value->id) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalTitle">HAPUS DATA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menghapus "{{ $value->nama_customer }}" ?</p>           
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
                        <button type="submit" class="btn btn-primary">HAPUS</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach
    <!-- modal delete end -->



    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Datatables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <!-- Date Picker -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

</body>
</html>