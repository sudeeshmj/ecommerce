@extends('layouts.master')
@section('admincontent')

    <section class="content">
        <div class="container-fluid">
          <form method="POST" id="bookSubmitForm" action="{{ route('books.store') }}"enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-7">
                    <div class="card mt-4">
                        <div class="card-header">
                            <h6>Add New Book</h6>
                        </div>
                        <div class="card-body">
                            
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-group mb-3">
                                    <label for="title" class="col-form-label">Title:</label>
                                    <input type="text" value="{{ old('title') }}"
                                        class='form-control @error('title') is-invalid @enderror' id="title"
                                        name="title">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-row mb-2">
                                    <div class="form-group col-md-6">
                                        <label for="category">Category</label>
                                        <select id="category-dropdown" value="{{ old('category_id') }}" title="Choose..."
                                            name="category_id"
                                            class="form-control  @error('category_id') is-invalid @enderror">

                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="subcategory">SubCategory</label>
                                        <select id="subcategory-dropdown" name="subcategory[]" title="Choose"
                                            class="form-control selectpicker  @error('subcategory') is-invalid @enderror"
                                            multiple>

                                        </select>
                                        @error('subcategory')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="author" class="col-form-label">Author:</label>
                                    <select id="author_id" name="author_id" title="Choose..." data-live-search="true"
                                        class="form-control   @error('author_id') is-invalid @enderror">

                                        @foreach ($authors as $author)
                                            <option value="{{ $author->id }}"
                                                {{ old('author_id') == $author->id ? 'selected' : '' }}>{{ $author->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('author_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="publisher" class="col-form-label">Publisher:</label>
                                    <select id="publisher_id" name="publisher_id"
                                        class="form-control  @error('publisher_id') is-invalid @enderror">
                                        <option selected value="">Choose...</option>
                                        @foreach ($publishers as $publisher)
                                            <option value="{{ $publisher->id }}"
                                                {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>
                                                {{ $publisher->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('publisher_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="publishing_date">Publishing Date</label>
                                        <input type="date" value="{{ old('publishing_date') }}"
                                            max="@php echo date('Y-m-d') @endphp"
                                            class="form-control @error('publishing_date') is-invalid @enderror"
                                            name="publishing_date" id="publishing_date">
                                        @error('publishing_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="edition">Edition</label>
                                        <input type="number" value="{{ old('edition') }}"
                                            class="form-control  @error('edition') is-invalid @enderror" id="edition"
                                            name="edition">
                                        @error('edition')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="isbn">ISBN</label>
                                        <input type="text" value="{{ old('isbn') }}"
                                            class="form-control @error('isbn') is-invalid @enderror" id="isbn"
                                            name="isbn">
                                        @error('isbn')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="language">Language</label>
                                        <select id="language_id" name="language_id"
                                            class="form-control @error('language_id') is-invalid @enderror">
                                            <option selected value="">Choose...</option>
                                            @foreach ($languages as $language)
                                                <option value="{{ $language->id }}">{{ $language->language_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('language_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 ">
                                        <label for="format">Format</label>
                                        <select id="format" name="format"
                                            class="form-control @error('format') is-invalid @enderror">
                                            <option selected value="">Choose...</option>
                                            @foreach ($formats as $format)
                                                <option value="{{ $format->id }}"
                                                    {{ old('format') == $format->id ? 'selected' : '' }}>{{ $format->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('format')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="pages">No.Pages</label>
                                        <input type="number" value="{{ old('pages') }}"
                                            class="form-control  @error('pages') is-invalid @enderror" id="pages"
                                            name="pages">
                                        @error('pages')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="summary" class="col-form-label">Summary:</label>
                                    <textarea name="summary" class="form-control @error('summary') is-invalid @enderror" id="summary" cols="30"
                                        rows="10">
                                      {{ old('summary') }}
                                    </textarea>
                                    @error('summary')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card mt-4">
                        <div class="card-header">
                            <h6 class="language_form_title">Book Image</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label for="tag" class="col-form-label">Tag</label>
                                <select id="test" name="test" class="form-control">
                                    <option selected value="">Choose...</option>
                                    @foreach ($languages as $language)
                                        <option value="{{ $language->id }}">{{ $language->language_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="status" class="col-form-label d-block">Book Image:</label>

                                <div class="book-img-container mb-3 d-none" id="book-img-container">
                                    <img src="{{ asset('images/book_sample.jpg') }}" class="book-image-preview"
                                        id="book-image-preview">
                                    <div class="image-action">
                                        <button class="btn btn-sm btn-secondary d-block  mb-2">Replace</button>
                                        <button class="btn btn-sm btn-danger d-block btn-remove ">Remove</button>
                                    </div>
                                </div>
                                <input type="file" id="upload" name="book_image" accept='image/*' hidden />
                                <label for="upload" class="file-upload-label btn btn-sm btn-book-img-upload">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                    Upload Image
                                </label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn float-right btn-primary btn-sm add_new_btn"
                                    id="btn_language_form">Create</button>
                            </div>

                           
                        </div>
                    </div>
                </div>
            </div>
          </form>
        </div>
            @if (session()->has('success'))
                <script>
                    toastr.success("{{ session()->get('success') }}")
                </script>
            @endif

            @if (session()->has('error'))
                <script>
                    toastr.error("{{ session()->get('error') }}")
                </script>
            @endif

    </section>

    <script>
        $(document).ready(function() {

            $('select').selectpicker();


    
            $("#author_id").siblings().find("input[type='search']").keyup(function (e) {
                const query = $(this).val().trim();  
                searchAuthors(query);
             });


             function searchAuthors (query) {

                alert(query);
             }



            $(document).on("change", "#upload", function(event) {

                var image = $('#book-image-preview');
                $('#book-img-container').removeClass('d-none')
                image.attr('src', URL.createObjectURL(event.target.files[0]));

            });

            const categoryId = $('#category-dropdown').val();
            const oldSubcategories = @json(old('subcategory', []));
            if (categoryId) {
                loadsubCategories(categoryId, oldSubcategories);
            }

            $(document).on('change', '#category-dropdown', function() {

                const categoryId = this.value.trim();
                $('#subcategory-dropdown').html('');

                if (categoryId) {
                    loadsubCategories(categoryId, []);

                } else {

                    $('#subcategory-dropdown').html('');
                }
            });

            function loadsubCategories(categoryId, oldSubcategories) {

                $.ajax({
                    url: "{{ route('fetch.subcategories') }}",
                    type: "POST",
                    data: {
                        category_id: categoryId,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(result) {

                        if (result.status == 'success') {
                            $.each(result.data, function(key, value) {

                                const isSelected = oldSubcategories.map(String).includes(String(
                                    value.id)) ? 'selected' : '';

                                $("#subcategory-dropdown").append('<option value="' + value.id +
                                    '"' + isSelected + '>' + value.name + '</option>');
                            });

                            $("#subcategory-dropdown").selectpicker('refresh');
                        } else {
                            $('#subcategory-dropdown').html('');

                        }

                    },
                    error: function(err) {

                        console.log(err);
                        $('#subcategory-dropdown').html('');
                    }

                });
            }

        });

        // $(document).on("click", "#author-profile-img-delete-btn", function () {

        //   var image = $('#author-profile-img');
        //   image.attr('src', "{{ asset('images/profile.png') }}");
        // });
    </script>

@endsection