$(document).ready(function() {
	
	$(".event").click(function() {
		$(".lightbox-bg").removeClass("hidden");
		id = $(this).attr("id");
		html = $("#"+id).html();
		$("#lb-content").html(html);
		hid = $("#"+id+"_h").html();
		notes = "info.php?id="+hid;
		$("#lb-notes").attr("href", notes);
	});
	
	$("#close").click(function() {
		$(".lightbox-bg").addClass("hidden");
	});
	
});