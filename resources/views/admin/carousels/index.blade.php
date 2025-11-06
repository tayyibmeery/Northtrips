{{-- resources/views/admin/carousels/index.blade.php --}}

@extends('admin.layout.app')

@section('title', 'North Trips & Travel - Carousel Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Carousel Items</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.carousels.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Carousel
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($carousels->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="carouselsTable">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Heading</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="sortable">
                                @foreach($carousels as $carousel)
                                <tr data-id="{{ $carousel->id }}">
                                    <td class="sortable-handle" style="cursor: move;">
                                        <i class="fas fa-arrows-alt-v"></i> {{ $carousel->order }}
                                    </td>
                                    <td>
                                        <img src="{{ asset('images/carousels/' . $carousel->image) }}" alt="Carousel Image" style="max-height: 60px; max-width: 100px; object-fit: cover;">
                                    </td>
                                    <td>{{ $carousel->title ?? 'N/A' }}</td>
                                    <td>{{ \Str::limit($carousel->heading, 50) ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge badge-{{ $carousel->is_active ? 'success' : 'danger' }}">
                                            {{ $carousel->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.carousels.edit', $carousel->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.carousels.destroy', $carousel->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this carousel?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-info">
                        No carousel items found. <a href="{{ route('admin.carousels.create') }}">Create the first one!</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .sortable-handle {
        cursor: move;
    }

    tr.sortable-ghost {
        opacity: 0.4;
    }

</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize sortable
        const sortable = new Sortable(document.getElementById('sortable'), {
            handle: '.sortable-handle'
            , ghostClass: 'sortable-ghost'
            , onEnd: function(evt) {
                const itemEl = evt.item;
                const order = Array.from(itemEl.parentNode.children).indexOf(itemEl);

                const ids = [];
                $('#sortable tr').each(function() {
                    ids.push($(this).data('id'));
                });

                // Update order via AJAX
                $.ajax({
                    url: '{{ route("admin.carousels.update-order") }}'
                    , type: 'POST'
                    , data: {
                        order: ids
                        , _token: '{{ csrf_token() }}'
                    }
                    , success: function(response) {
                        // Update order numbers in table
                        $('#sortable tr').each(function(index) {
                            $(this).find('.sortable-handle').html(
                                '<i class="fas fa-arrows-alt-v"></i> ' + index
                            );
                        });
                    }
                });
            }
        });
    });

</script>
@endpush
