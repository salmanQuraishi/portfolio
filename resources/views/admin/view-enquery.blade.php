@extends('admin.common.masterpage')
@section('content')

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Enquiry</h4>
            <div class="table-responsive">
              <table id="example" class="table table-dark table-hover" style="width:100%">
                <thead>
                  <tr>
                    <th>Sr.</th>
                    <th>User Details</th>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($enquiry as $enquirys) 
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>
                        <div><strong>Name:</strong> {{ $enquirys->name }}</div>
                        <div><strong>Email:</strong> {{ $enquirys->email }}</div>
                        <div><strong>Phone:</strong> {{ $enquirys->phone }}</div>
                      </td>
                      <td>{{ $enquirys->service->title }}</td>
                      <td>
                        <button class="btn 
                          {{ $enquirys->status == 'pending' ? 'btn-inverse-warning' : 
                             ($enquirys->status == 'resolved' ? 'btn-inverse-success' : 'btn-inverse-danger') }}">
                          {{ $enquirys->status }}
                        </button>
                      </td>
                      <td>{{ $enquirys->created_at->format('Y-m-d') }}</td>
                      <td>
                        <button 
                          class="btn btn-inverse-info viewInfo" 
                          data-id="{{ $enquirys->id }}"
                          data-name="{{ $enquirys->name }}"
                          data-email="{{ $enquirys->email }}"
                          data-phone="{{ $enquirys->phone }}"
                          data-service="{{ $enquirys->service->title }}"
                          data-message="{{ $enquirys->message }}"
                          data-status="{{ $enquirys->status }}"
                          data-date="{{ $enquirys->created_at->format('Y-m-d') }}"
                        >
                        View
                        </button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="enquiryModal" tabindex="-1" role="dialog" aria-labelledby="enquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content text-dark">
        <div class="modal-header">
          <h5 class="modal-title" id="enquiryModalLabel">Enquiry Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="modalId">
          <p><strong>Name:</strong> <span id="modalName"></span></p>
          <p><strong>Email:</strong> <span id="modalEmail"></span></p>
          <p><strong>Phone:</strong> <span id="modalPhone"></span></p>
          <p><strong>Service:</strong> <span id="modalService"></span></p>
          <p><strong>Message:</strong> <span id="modalMessage"></span></p>
          <p><strong>Status:</strong> <span id="modalStatus"></span></p>
          <p><strong>Date:</strong> <span id="modalDate"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="approveBtn">Resolved</button>
          <button type="button" class="btn btn-danger" id="rejectBtn">Reject</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Include jQuery and DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Script -->
<script>
  let dataTable;

  $(document).ready(function() {
    dataTable = $('#example').DataTable();

    $(document).on('click', '.viewInfo', function() {
      const button = $(this);
      $('#modalId').val(button.data('id'));
      $('#modalName').text(button.data('name'));
      $('#modalEmail').text(button.data('email'));
      $('#modalPhone').text(button.data('phone'));
      $('#modalService').text(button.data('service'));
      $('#modalMessage').text(button.data('message'));
      $('#modalStatus').text(button.data('status'));
      $('#modalDate').text(button.data('date'));

      $('#enquiryModal').data('row', button.closest('tr'));
      $('#enquiryModal').modal('show');
    });

    $('#approveBtn').on('click', function() {
      updateEnquiryStatus($('#modalId').val(), 'resolved');
    });

    $('#rejectBtn').on('click', function() {
      updateEnquiryStatus($('#modalId').val(), 'reject');
    });

    const baseUpdateUrl = "{{ url('admin/contact/enquiry/update-status') }}";

    function updateEnquiryStatus(id, status) {
      $.ajax({
        url: baseUpdateUrl + '/' + id,
        method: 'POST',
        data: {
          _token: '{{ csrf_token() }}',
          status: status
        },
        success: function(response) {
          $('#enquiryModal').modal('hide');

          const row = $('#enquiryModal').data('row');
          const statusCell = row.find('td').eq(3);
          let btnClass = 'btn btn-inverse-warning';
          if (status === 'resolved') btnClass = 'btn btn-inverse-success';
          else if (status === 'reject') btnClass = 'btn btn-inverse-danger';

          statusCell.html(`<button class="${btnClass}">${status}</button>`);

          row.find('.viewInfo').data('status', status);
        },
        error: function() {
          alert('Status update failed.');
        }
      });
    }
  });
</script>
@endsection