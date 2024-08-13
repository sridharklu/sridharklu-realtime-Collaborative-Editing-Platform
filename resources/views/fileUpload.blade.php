@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" required>
                    <button type="submit">Upload</button>
                </form>
                <div id="status"></div>
            </div>
        </div>
       
        <div class="card mt-5">
            <div class="card-header">
            uploaded Files
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">File name</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($files as $index => $file)
                      
                      <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ basename($file) }}</td>
                        <td>
                          <!-- Provide actions such as download or delete -->
                          {{-- <a href="{{ Storage::url($file) }}" class="btn btn-primary">Download</a> --}}
                          <a href="{{ route('file.download', ['file' => basename($file)]) }}" class="btn btn-primary">Download</a>

                          <!-- Example delete action -->
                          <form action="{{ route('file.delete', ['file' => basename($file)]) }}" method="POST" style="display:inline;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/pusher-js@latest/dist/pusher.min.js"></script>
    <script>
        // Initialize Pusher
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            forceTLS: true
        });

        // Subscribe to the channel
        var channel = pusher.subscribe('file-upload');

        // Bind to the event
        channel.bind('FileUploaded', function(data) {
            document.getElementById('status').innerText = 'File Uploaded: ' + data.fileName;
        });
    </script>
@endsection
