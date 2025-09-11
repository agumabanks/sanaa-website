<!DOCTYPE html>
<html>
<body style="font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, Noto Sans, Arial, sans-serif; color:#111;">
    @if($isReceipt)
        <p>Hi {{ $data['full_name'] }},</p>
        <p>Thank you for contacting Sanaa Finance. Our team will reach out shortly.</p>
    @else
        <p><strong>New Finance Contact</strong></p>
    @endif

    <table cellpadding="6" cellspacing="0" style="border-collapse:collapse;">
        <tr><td><strong>Name</strong></td><td>{{ $data['full_name'] }}</td></tr>
        <tr><td><strong>Email</strong></td><td>{{ $data['email'] }}</td></tr>
        @if(!empty($data['phone']))<tr><td><strong>Phone</strong></td><td>{{ $data['phone'] }}</td></tr>@endif
        <tr><td><strong>Organization</strong></td><td>{{ $data['organization'] }}</td></tr>
        <tr><td><strong>Country</strong></td><td>{{ $data['country'] }}</td></tr>
        <tr><td><strong>Segment</strong></td><td>{{ $data['segment'] }}</td></tr>
        @if(!empty($data['monthly_volume']))<tr><td><strong>Monthly Volume</strong></td><td>{{ $data['monthly_volume'] }}</td></tr>@endif
        @if(!empty($data['message']))<tr><td><strong>Message</strong></td><td>{{ $data['message'] }}</td></tr>@endif
        <tr><td><strong>Book a demo</strong></td><td>{{ !empty($data['book_demo']) ? 'Yes' : 'No' }}</td></tr>
    </table>
    <p style="color:#6b7280; font-size:12px;">Sent from sanaa.co/finance</p>
</body>
</html>

