$(document).ready(function() {
	
	$(".event").click(function() {
		$(".lightbox-bg").removeClass("hidden");
		var id = $(this).attr("id");
		var html = $("#"+id).html();
		var hid = $("#"+id+"_as").html();
		if (hid !== undefined) {
			var html2 = html+"<br><br>"+hid;
			$("#lb-content").html(html2);
		} else {
			$("#lb-content").html(html);
		}
		
		var notes = "info.php?n="+id;
		$("#info").attr("href", notes);
		var elink = "event-edit.php?id="+id;
		$("#event-edit").attr("href", elink);
		var addnote = "add-notes.php?id="+id;
		$("#add-notes").attr("href", addnote);
		var task = "add-task.php?id="+id;
		$("#add-task").attr("href", task);
	});
	
	$("#close").click(function() {
		$(".lightbox-bg").addClass("hidden");
	});
	
});