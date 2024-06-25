@extends('admin.index')

@section('main-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"> {{ $title }} </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      {{-- <a href="/admin/terms/create" type="button" class="btn btn-primary">
        Tambah Data
      </a> --}}
    </div>
</div>

<div class="row">
    <div class="col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
        <div class="card-body p-4">
            <div class="card-body p-4">
                <div class="row alig n-items-start">
                    <div class="col-8">
                    <h5 class="card-title mb-9 fw-semibold">
                        Total Data (Istilah)
                    </h5>
                    <h4 class="fw-semibold mb-3">{{ $musicTermsCount }}</h4>
                    <div class="d-flex align-items-center pb-1">
                    </div>
                    </div>
                    <div class="col-4">
                    <div class="d-flex justify-content-end">
                        <div
                        class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center"
                        >
                        <i class="ti ti-book fs-6"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
        </div>
        </div>
    </div>
    <div class="col-lg-8 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">
                        Pencarian Istilah Musik
                        </h5>
                    <div class="row">
                        <div class="col-10">
                            <input class="form-control form-control-dark" type="text" id="searchInput" placeholder="Masukan istilah disini..." aria-label="Search">
                        </div>
                        <div class="col">
                            <button id="searchButton" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 d-flex align-items-stretch">
        {{-- <div class="card w-100">
        <div class="card-body p-4">
            <div class="card-body p-4">
                <div class="row alig n-items-start">
                    <div class="col-8">
                    <h5 class="card-title mb-9 fw-semibold">
                        Total Data (Istilah)
                    </h5>
                    <h4 class="fw-semibold mb-3">{{ $musicTermsCount }}</h4>
                    <div class="d-flex align-items-center pb-1">
                    </div>
                    </div>
                    <div class="col-4">
                    <div class="d-flex justify-content-end">
                        <div
                        class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center"
                        >
                        <i class="ti ti-book fs-6"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
        </div>
        </div> --}}
    </div>
    <div class="col-lg-8">
        <div class="card w-100 p-4">
            <div id="searchResults"><i>Search Result...</i></div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $("#searchButton").click(function(){
            var searchQuery = $("#searchInput").val();
            $.ajax({
                url: "http://127.0.0.1:8000/music",
                type: "GET",
                data: {
                    search: searchQuery
                },
                success: function(response){
                    displaySearchResults(response);
                },
                error: function(xhr, status, error){
                    console.error("Error:", error);
                }
            });
        });

        function displaySearchResults(results) {
            var searchResultsDiv = $("#searchResults");
            searchResultsDiv.empty(); // Bersihkan hasil pencarian sebelum menambahkan yang baru

            if (results.data.length > 0) {
                var sortedResults = results.data;
                if (results.search_result_mode != "Normal") {
                    // Mengurutkan hasil pencarian berdasarkan similarity (menurun)
                    sortedResults.sort(function(a, b) {
                        return b.similarity - a.similarity;
                    });
                }

                $.each(sortedResults, function(index, result) {
                    // Membuat elemen card untuk setiap hasil pencarian
                    var card = $("<div class='card border-primary' style='box-shadow: none;'></div>");
                    var cardBody = $("<div class='card-body text-dark' style='border-style: dashed; border-color:blue;border-radius: 10px;'></div>");

                    // Menambahkan similarity jika tidak "Normal" mode
                    if (results.search_result_mode != "Normal") {
                        var title = $("<h5 class='card-title'>" + result.nearestString + "</h5>");
                        var description = $("<p class='card-text'>" + result.description + "</p>");
                        var similarity = $("<p class='card-text'><i>" + "Similarity: " + result.similarity + "%" + "</i></p>");
                        cardBody.append(title);
                        cardBody.append(description);
                        cardBody.append(similarity);
                    } else {
                        var title = $("<h5 class='card-title'>" + result.title + "</h5>");
                        var description = $("<p class='card-text'>" + result.description + "</p>");
                        cardBody.append(title);
                        cardBody.append(description);
                    }

                    card.append(cardBody);
                    searchResultsDiv.append(card);
                });
            } else {
                searchResultsDiv.append("<p>No results found.</p>");
            }
        }
    });
    </script>
@endsection
