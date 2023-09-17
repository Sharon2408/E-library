<div class="container mt-5">
    <div class="row">
        <div class="col col-sm-12">
            <div class="mb-3 mt-3">
             @csrf
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control" id="" placeholder="The Alchemist" name="title"
                    autocomplete="off" value="{{ old('title') ?? $book->title }}">
                 <small class="text-danger"> {{ $errors->first('title') }}</small>
            </div>
            <div class="mb-3">
                <label for="Author" class="form-label">Author</label>
                <input type="text" class="form-control" id="" placeholder="Paulo Coelho" name="author"
                    autocomplete="off" value="{{ old('author') ?? $book->author }}">
                <small class="text-danger"> {{ $errors->first('author') }}</small>
            </div>
            <div class="mb-3 mt-3">
                <label for="Published Year" class="form-label">Published Year</label>
                <input type="text" class="form-control" id="" placeholder="2012" name="published_year"
                    autocomplete="off" value="{{ old('published_year') ?? $book->published_year }}">
                <small class="text-danger"> {{ $errors->first('published_year') }}</small>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea type="text" class="form-control" id="" placeholder="Lorem, ipsum dolor sit....... " name="description"
                    value="{{ old('description') ?? $book->description }}" rows="3">{{ old('description') ?? $book->description }}</textarea>
                <small class="text-danger"> {{ $errors->first('description') }}</small>
            </div>
            <div class="mb-3">
                <label class="form-label" for="Select Category">Select Category</label>
                <select class="form-control" name="category_id" id="">
                  <option value="" class="dropdown-item disabled" >--Select</option>
                  <option value="1" class="dropdown-item disabled" >Mystery</option>
                     @foreach ($book->getCategoryid() as $categorykey => $categoryvalue)
                        <option value={{$categorykey}} {{$book->category_id == $categoryvalue ? 'selected' : ''}} >{{ $categoryvalue }}</option>
                    @endforeach 
                 </select>
                <small class="text-danger"> {{ $errors->first('category_id') }}</small>
                <br>
            </div>
              <div class="mb-3">
                <label for="Upload Image" class="form-label">Upload Image</label>
                <input type="file" class="form-control" value="{{ old('image') ?? $book->image }}" name="image" >
                <small class="text-danger"> {{ $errors->first('image') }}</small>
            </div>
            <div class="mb-3">
                <label for="Upload Book Pdf" class="form-label">Upload Book Pdf</label>
                <input type="file" class="form-control" value="{{ old('pdf') ?? $book->pdf }}" name="pdf" >
                <small class="text-danger"> {{ $errors->first('pdf') }}</small>
            </div>
        </div>
    </div>