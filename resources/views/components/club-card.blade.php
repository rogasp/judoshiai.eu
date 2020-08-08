@inject('countries','App\Http\Utilities\Country')
<div class="card">
    <div class="card-header">{{ $club->name }}</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p class="card-text">Phone: {{ $club->phone }}</p>
                <p class="card-text">E-Mail: {{ $club->email }}</p>
                <p class="card-text">City: {{ $club->city }}</p>
                <p class="card-text">Country: {{ $countries::get($club->country_code) }}</p>
            </div>
            <div class="col-md-6">
                <p class="card-text">Owner: {{ $club->owner->name }}</p>
                <p class="card-text">{{ $club->is_activated() ? "Activated {$club->activated_at}" : 'Not activated yet' }}</p>
                <p class="card-text">{{ $club->is_approved() ? "Approved {$club->approved_at}" : 'Not approved yet' }}</p>
            </div>
            <div class="col-md-12">
                <hr>
                <div class="card-title">Administrators</div>
                <ul class="list-group list-group-flush">
                    @forelse($club->administrators as $administrators)
                        <li class="list-group-item">{{ $administrators->name }}</li>
                    @empty
                        <p class="card-text">No administrators</p>
                    @endforelse

                </ul>
            </div>
        </div>
        <div class="card-footer">
            <p class="card-text"><small class="text-muted">Last updated {{ $club->updated_at->diffForHumans() }}</small></p>
        </div>
    </div>
</div>
