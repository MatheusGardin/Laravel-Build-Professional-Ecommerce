<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Edit Category
                        </div>
                        <div class="card-body">
                            <form action="{{ url('category/update/'.$categories->id) }}" method="POST">
                                @csrf
                                <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                                <div class="form-group">
                                    <label for="category_name">Update Category Name</label>
                                    <input type="text" class="form-control" id="category_name"
                                        name="category_name" value="{{ $categories->category_name}}">
                                </div>
                                @error('category_name')
                                    <span class="text-danger"> {{$message}} </span>
                                @enderror
                                <br>
                                <button type="submit" class="btn btn-primary">Update Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>