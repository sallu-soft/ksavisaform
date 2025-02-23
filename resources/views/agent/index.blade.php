<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            clifford: '#da373d',
          }
        }
      }
    }
  </script>
  <style>
    .hide-scroll-bar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }

    .hide-scroll-bar::-webkit-scrollbar {
      display: none;
    }
  </style>
  @include('layout.head')
</head>

<body class="flex">
  @include('layout.sidebar')
    <div class="flex-1 xl:ml-[280px]">
    @include('layout.navbar')
    <h2 class=" w-[70%] mx-auto font-semibold py-2 text-2xl">Agents List</h2>
    <div class="w-[70%] mx-auto shadow-lg p-4 mt-4">
      
      <div class="table-responsive main-datatable ">
        {{-- <form method="GET" action="{{ route('user/index') }}">
            <div class="flex w-[50%] mx-auto gap-4">
                <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request('search') }}">
                <button type="submit" class="text-white px-4 rounded-lg bg-indigo-500">Search</button>
            </div>
        </form> --}}
      <table class="table stripe no-footer dataTable passenger-table" id="candidatetable">
        <thead class="bg-green-500 thed">
          <tr class="bg-green-500">
            <th scope="col">Serial <br/> Number</th>
            
            <th scope="col">Name</th>
            <th scope="col">Phone <br/> Number</th>
            <th scope="col">Email <br/></th>
            <th scope="col">Address</th>
           
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($agents as $index => $agent)
              <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $agent->agent_name }}</td>
                  <td>{{ $agent->agent_phone }}</td>
                  <td>{{ $agent->agent_email }}</td>
                  <td>{{ $agent->agent_address }}</td>
                  <td class="flex gap-2">
                    <a href="{{ route('agent.edit', $agent->id) }}" class="btn btn-primary"><i class="bi bi-pencil-square mr-1"></i></a>
                    <a href="#" class="btn btn-secondary view-agent-btn" data-bs-toggle="modal" data-agent-id="{{ $agent->id }}"><i class="bi bi-eye"></i></a>
                    <form action="{{ route('agent.delete', $agent->id) }}" method="POST" class="delete-form" data-confirm-message="Are you sure you want to delete this agent?">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash mr-1"></i></button>
                    </form>
                </td>
                
              </tr>
          @endforeach
        
        </tbody>
      </table>
      {{ $agents->links() }}
    </div>
    <div class="modal fade" id="viewAgentModal" tabindex="-1" aria-labelledby="viewAgentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewAgentModalLabel">Agent Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="agentDetails">

            </div>
        </div>
    </div>
</div>
</div>
    <script>
        $('.view-agent-btn').click(function(e) {
            e.preventDefault();
            var agentId = $(this).data('agent-id');

            $.ajax({
                url: '{{ route("agent.view", ":id") }}'.replace(':id', agentId),
                type: 'GET',
                success: function(response) {
                    $('#agentDetails').html(response.html);
                    $('#viewAgentModal').modal('show');
                },
                error: function(xhr) {
                    console.error('Failed to fetch agent details');
                }
            });
        });
    </script>
    @include('layout.script')
  </div>
</body>

</html>