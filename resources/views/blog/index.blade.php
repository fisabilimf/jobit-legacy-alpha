@extends('layouts.app')

@section('content')
<div class="container">
    <div class="py-5"></div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="{{asset('blogs/blog1.jpg')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Cari Kerja Tapi Belum Punya Pengalaman? Bisa!</h5>
                    <p class="card-text">Kamu suka bingung gak saat ngelamar pekerjaan tapi di kualifikasinya minimal setahun sampai dua tahun pengalaman kerja? Harus gimana ya? Tenang, kamu ngga sendirian. Pengalaman ini pastinya sering dialami oleh para fresh graduate yang baru lulus kuliah dan belum memiliki pengalaman kerja. Fresh graduate seringkali dihadapkan pada tantangan saat melamar pekerjaan karena tidak ada pengalaman kerja yang dapat membuktikan kualifikasi mereka. Hal ini menjadi penghambat mereka dalam menemukan kari</p>
                    <a href="#" class="btn btn-primary">Reaad More</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="{{asset('blogs/blog2.jpg')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">3 Cara Cegah Meningkatnya Angka Turnover Karyawan Pasca Lebaran</h5>
                    <p class="card-text">Momen Hari Raya Idul Fitri atau lebaran memang telah usai. Tapi bayang - bayang turnover karyawan pasca lebaran harus siap dihadapi oleh para HR. Apalagi jika tingkat turnover tinggi atau meningkat dari periode sebelumnya, HR harus menyiapkan strategi dan cara agar mencegah terjadinya hal ini. Fenomena turnover ini cukup sering terjadi khususnya di hari - hari libur yang cukup lama, jika di Indonesia biasanya terjadi saat Hari Raya Idul Fitri maka di negara lain seperti Eropa atau Negara Bara</p>
                    <a href="#" class="btn btn-primary">Reaad More</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
        <div class="py-5">
            <ul class="list-group">
                <h3 class="list-group-item font-weight-bold">CATEGORIES</h3>
                <li class="list-group-item font-weight-bold">B2B</li>
                <li class="list-group-item font-weight-bold">News</li>
                <li class="list-group-item font-weight-bold">Product Relases</li>
                <li class="list-group-item font-weight-bold">Support</li>
            </ul>
        </div>
        </div>
    </div>
    <div class="py-4"></div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="{{asset('blogs/blog3.jpg')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">5 Eye-Opening Questions to Answer Before Outsourcing Remote Employees</h5>
                    <p class="card-text">Businesses who are looking to grow exponentially while saving salary costs often look at employee outsourcing. Here are 5 questions to answer before deciding to outsource.</p>
                    <a href="#" class="btn btn-primary">Reaad More</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="{{asset('blogs/blog4.jpg')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">How Can Small Companies Attract the Best Talent?</h5>
                    <p class="card-text">To attract the right talent, any organisation needs a powerful talent acquisition strategy. Large companies have considerable internal resources to attract talent. But how can small companies find the right employees?</p>
                    <a href="#" class="btn btn-primary">Reaad More</a>
                </div>
            </div>
        </div>
    </div>
    <div class="py-4"></div>
    <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>
</div>
@endsection