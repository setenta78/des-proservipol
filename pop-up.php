<!DOCTYPE html>
<html>

<head>
	<title>showModalDialog</title>
</head>

<body>
	<form id="oForm">
		<div style="display:none;">
			Dialog Height
			<select id="oHeight">
				<option>600</option>
			</select>
			<p>Create Modal Dialog Box</p>
			<input type="button" value="Push To Create" onclick="fnOpen()" />
		</div>
	</form>
	<script>
		fnOpen();
/*
		function fnRandom(iModifier) {
			return parseInt(Math.random() * iModifier);
		}

		function fnSetValues() {
			var oForm = document.getElementById('oForm');
			var iHeight = oForm.oHeight.options[oForm.oHeight.selectedIndex].text;

			// alert(iHeight);

			if (iHeight.indexOf("Random") > -1) {
				iHeight = fnRandom(document.body.clientHeight);
			}

			//var sFeatures = "dialogHeight: " + iHeight + "px;";
			var sFeatures = "dialogHeight: " + iHeight + "px;"+"dialogwidth: " + 1000 + "px;"+"resizable: off; center:on; ";
			return sFeatures;
		}
*/
		function fnOpen() {
			var sFeatures = "dialogHeight: " + 600 + "px;"+"dialogwidth: " + 1000 + "px;"+"resizable: off; center:on; ";
			//var sFeatures = fnSetValues();
			window.showModalDialog("popup_content.php", "", sFeatures)
			// window.showModalDialog(uri[, arguments][, options]);
		}
	</script>
</body>

</html>