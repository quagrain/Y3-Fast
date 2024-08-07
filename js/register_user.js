function handleSignUp(event) {
  event.preventDefault();

  const email = document.getElementById("email").value;
  const username = document.getElementById("username").value;
  const usertype = document.getElementById("usertype").value;
  const password = document.getElementById("passwd").value;
  const rePassword = document.getElementById("re_passwd").value;

  var fname, lname, dob, occup, descrip;
  var org_name, creation_date, industry, tagIds;

  if (usertype == "JobSeeker") {
    fname = document.getElementById("fname").value;
    lname = document.getElementById("lname").value;
    dob = document.getElementById("date_of_birth").value;
    occup = document.getElementById("occupation").value;
    descrip = document.getElementById("description").value;
  } else if (usertype == "Employer") {
    org_name = document.getElementById("org_name").value;
    creation_date = document.getElementById("creation_date").value;
    industry = document.getElementById("industry").value;
    tagIds = [];
    if (usertype === "Employer") {
      var select = document.getElementById("tags");
      for (var i = 0; i < select.options.length; i++) {
        if (select.options[i].selected) {
          tagIds.push(select.options[i].value);
        }
      }

      // tagIds = JSON.stringify(tagIds);
    }
  }

  const Data = {
    email: email,
    username: username,
    usertype: usertype,
    passwd1: password,
    passwd2: rePassword,
    fname: fname,
    lname: lname,
    dob: dob,
    occup: occup,
    descrip: descrip,
    org_name: org_name,
    creation_date: creation_date,
    industry: industry,
    tagIds: tagIds,
  };

  fetch("./actions/register_user_action.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(Data),
  })
  .then((response) => {
    if (!response.ok) {
      throw new Error("Network response was not ok: " + response.statusText);
    }
    return response.json();
  })
  .then((response) => {
    if (response.status === 1) {
      window.location.href = response.redirect;
      console.log(response.message);
    } else {
      alert("Sign Up failed: " + response.message);
      throw new Error(response.message);
    }
  })
  .catch((error) => {
    console.error("Error:", error);
  });

}
