@{
    ViewBag.Title = "Index";
}
<h2>Index</h2>
<button id="test">Test</button>
@using (Html.BeginForm("CreateEdit", "ClientSideValidation", FormMethod.Post))
{
    <input type="hidden" id="hfAU" name="hfAU" value="A" />
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">Ã—</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
}
@section scripts{
    <script src="~/Scripts/jquery.validate.min.js"></script>
    <script src="~/Scripts/jquery.validate.unobtrusive.min.js"></script>
    <script>
        $("body").on("click", "#test", function () {
               $.ajax({
                 url: "@Url.Action("TestPartialView", "ClientSideValidation")",
                 type: "Get",
                 success: function (result) {
                     $(".modal-body").html(result);
                     $("#myModal").modal("show");
                     $.validator.unobtrusive.parse("#myModal");
                 }
             });
        });
    </script>
}