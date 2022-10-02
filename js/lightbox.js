$(document).ready(function() {
	
	var color = "c_webdev";
	
	$(".event").click(function() {
		var id = $(this).attr("id");
		var html = $("#"+id).html();
		var hid = $("#"+id+"_an").html();
		var dateID = $("#"+id+"_date").text();
		html = dateID+"<br><br>"+html;
		if (hid !== undefined) {
			var html2 = html+"<br><br>"+hid;
			$("#lb-content").html(html2);
		} else {
			$("#lb-content").html(html);
		}
		
		var classes = $(this).attr("class");
		color = classes.substring(5);
		$(".lightbox").addClass(color);
		
		var notes = "info.php?n="+id;
		$("#info").attr("href", notes);
		var elink = "event-edit.php?id="+id;
		$("#event-edit").attr("href", elink);
		var addnote = "add-notes.php?id="+id;
		$("#add-notes").attr("href", addnote);
		var task = "add-task.php?id="+id;
		$("#add-task").attr("href", task);
		
		$(".lightbox-bg").removeClass("hidden");
	});
	
	$("#close").click(function() {
		$(".lightbox-bg").addClass("hidden");
		$(".lightbox").removeClass(color);
	});
	
});