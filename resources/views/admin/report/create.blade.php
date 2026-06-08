@extends('layouts.admin')

@section('title', 'Create Report')
@section('breadcrumb', 'Reports')
@section('page-title', 'Create Report')

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('admin.report.export') }}" method="GET" class="row g-3">
      <div class="col-md-5">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="date" name="start_date" id="start_date" class="form-control" required>
      </div>
      <div class="col-md-5">
        <label for="end_date" class="form-label">End Date</label>
        <input type="date" name="end_date" id="end_date" class="form-control" required>
      </div>
      <div class="col-md-2 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100">
          <i class="bi bi-download"></i> Export CSV
        </button>
      </div>
    </form>
  </div>
</div>
@endsection