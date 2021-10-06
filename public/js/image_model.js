



function imageDetailsModel(imageId)
{
    if(imageId)
    {
       
        editingImageId = imageId;
        fetch(`${baseUrl}/web_image_details/${imageId}`, {
            method: 'GET'
        }).then(res => res.json())
            .then(res => {
                console.log(res);
               
            });
        $('#image_details').modal({show:true});
    }
}