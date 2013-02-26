<% if Slides %>
<ul class="rslides">
	<% loop Slides %>
		<% if not $Draft %>
		<li>
			<% with Image %>
				<% with CroppedImage(940,400) %>
					<img src="1.jpg" alt="$Title.XML">
				<% end_with %>
			<% end_with %>

			<% if $Title %>
			<p class="caption">$Title</p>
			<% end_if %>
		</li>
		<% end_if %>
	<% end_loop %>
</ul>
<% end_if %>
