<p>You have received a new support request.</p>
<p><strong>Name:</strong> {{ $name }}</p>
@if($email)
<p><strong>Email:</strong> {{ $email }}</p>
@endif
@if($phone)
<p><strong>Phone:</strong> {{ $phone }}</p>
@endif
@if($address)
<p><strong>Address:</strong> {{ $address }}</p>
@endif
@if($product)
<p><strong>Product:</strong> {{ $product }}</p>
@endif
<p><strong>Message:</strong></p>
<p>{{ $content }}</p>
