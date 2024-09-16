
        var filePath = "IMAGEM";
        var url = "http://localhost:3000/";

        using (var client = new HttpClient())
        using (var form = new MultipartFormDataContent())
        {
            var imageBytes = System.IO.File.ReadAllBytes(filePath);
            var imageContent = new ByteArrayContent(imageBytes);
            imageContent.Headers.ContentType = MediaTypeHeaderValue.Parse("image/jpeg");
            
            form.Add(imageContent, "upload", "imagem.jpg");
            
            var response = await client.PostAsync(url, form);
            var responseString = await response.Content.ReadAsStringAsync();

            Console.WriteLine(responseString);
        }