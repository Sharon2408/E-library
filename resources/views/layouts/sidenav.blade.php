<body>
<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.side-navbar {
  width: 250px;
  height: 100%;
  position: fixed;
  margin-left: -300px;
  background-color: #100901;
  transition: 0.5s;
}

.nav-link:active,
.nav-link:focus,
.nav-link:hover {
  background-color: #ffffff26;
}

.my-container {
  transition: 0.4s;
}

.active-nav {
  margin-left: 0;
}

/* for main section */
.active-cont {
  margin-left: 250px;
}

#menu-btn {
  background-color: #100901;
  color: #fff;
  margin-left: -62px;
}

.my-container input {
  border-radius: 2rem;
  padding: 2px 20px;
}


</style>
  <!-- Side-Nav -->
  <div class="side-navbar active-nav d-flex justify-content-between flex-wrap flex-column" id="sidebar">
    <ul class="nav flex-column text-white w-100 ">
      <a href="#" class="nav-link h3 text-white ">
        Responsive </br>SideBar Nav
      </a>
      <li class="nav-link">
        <i class="bx bxs-dashboard"></i>
        <a href="" class="mx-2 text-white text-decoration-none fs-4">Home</a>
      </li>
      <li class="nav-link">
        <i class="bx bx-user-check"></i>
         <a href="" class="mx-2 text-white text-decoration-none fs-4">Contact</a>
      </li>
      <li class="nav-link">
        <i class="bx bx-conversation"></i>
        <a href="" class="mx-2 text-white text-decoration-none fs-4">Profile</a>
      </li>
    </ul>
  </div>
</body>
</html>