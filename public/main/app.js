class FetchDB {
    constructor(dataURI) {
      this.dataURI = dataURI;
    }

   async getResult() {
    const response = await fetch(this.dataURI);
    if (response.status !== 200) {
        throw new Error('Cannot fetch data');
    }
    const data = await response.json();

    return data;
    }

    async setForm(formData) {
      const response = await fetch(this.dataURI, {
        method: 'POST',
        body: formData
    });

    if (response.status !== 200) {
      throw new Error('Cannot fetch data');
    }
    const data = await response.text();

    return data;
    }
}

const contact = new FetchDB('http://localhost/banksphpmvcframework/public/ajax');

const contactForm = document.querySelector("#contact-form");
const formMessage = document.querySelector('.form-message');

contactForm.addEventListener('submit', async (e) => {

    e.preventDefault();

    const formData = new FormData(contactForm);
    formData.append('property', 'value');
    contact.setForm(formData)
        .then(data => {

            if (data.includes("Thank you for contacting us")) {
                formMessage.classList.remove("alert-danger");
                formMessage.classList.add("alert-success");
                formMessage.innerText = data;
                contactForm.reset();  
            } else if(data.includes("Please enter your name") || data.includes("Please your email") || data.includes("Please the subject") || data.includes("Please enter your message") || data.includes("Enter proper e-mail!")) {
                formMessage.classList.remove("alert-success");
                formMessage.classList.add("alert-danger");
                formMessage.innerText = data;
            }
          
        })
        .catch(err => console.log('rejected', err.Message));
});
