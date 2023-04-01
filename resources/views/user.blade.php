@extends('master')
@section('content')

<div class="container-fluid">
  <div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
      <div class="white-box">
        <div class="user-bg">
          <img
            width="100%"
            alt="user"
            src="plugins/images/large/img1.jpg"
          />
          <div class="overlay-box">
            <div class="user-content">
              <a href="javascript:void(0)"
                ><img
                  src="plugins/images/users/genu.jpg"
                  class="thumb-lg img-circle"
                  alt="img"
              /></a>
              <h4 class="text-white mt-2">{{ Auth::user()->username }}</h4>
              <h5 class="text-white mt-2">{{ Auth::user()->email }}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Column -->

    <!-- Column -->
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h4>Tambah user</h4>
          <form action="/user/create" method="post">
            @csrf
            <div class="form-group">
              <label for="name">Nama</label>
              <input
                type="text"
                class="form-control"
                name="name"
                required
                placeholder="name"
              />
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input
                type="text"
                class="form-control"
                name="username"
                required
                placeholder="username"
              />
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="text"
                class="form-control"
                name="email"
                required
                placeholder="email"
              />
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input
                type="password"
                class="form-control"
                name="password"
                required
                placeholder="password"
              />
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </form>
        </div>
      </div>
    </div>
    <!-- Column -->

    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr>
                  <form action="/user/update/{{ $users[0]->id }}" method="POST">
                    @csrf
                    <td>
                      <input
                        type="text"
                        class="form-control"
                        name="name"
                        required
                        placeholder="name"
                        value="{{ $user->name }}"
                      />
                    </td>
                    <td>
                      <input
                        type="text"
                        class="form-control"
                        name="username"
                        required
                        placeholder="username"
                        value="{{ $user->username }}"
                      />
                    </td>
                    <td>
                      <input
                        type="text"
                        class="form-control"
                        name="email"
                        required
                        placeholder="email"
                        value="{{ $user->email }}"
                      />
                    </td>
                    <td>
                      <input
                        type="password"
                        class="form-control"
                        name="password"
                        placeholder="password"
                      />
                    <td>
                      <button class="btn btn-success btn-simpan" type="submit">Simpan</button>
                      <button type="button" class="btn btn-danger btn-delete" data-id="{{ $user->id }}">Hapus</button>
                    </td>
                  </form>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Column -->
  </div>
</div>


@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function () {
    // btn delete on click
    $(".btn-delete").click(function (e) {
      e.preventDefault();
      var id = $(this).data("id");
      Swal.fire({
        title: "Apakah anda yakin?",
        text: "Data akan dihapus",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus!",
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = "/user/delete/" + id;
        }
      });
    });

  });
</script>

@if(session('pesan'))
<script>
  Swal.fire({
    icon: "success",
    title: "Berhasil",
    text: "{{ session('pesan') }}",
  });
</script>
@endif
@endsection