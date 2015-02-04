  <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">

            <ul class="sidebar-nav">
                <li>
                    {{link_to_route('posts-all','All Posts')}}
                 </li>
                <li>
                    {{link_to_route('posts-show-sales','My Posts')}}
                </li>
                <li>
                <!-- Show messages -->
                    {{link_to_route('message-index','Messages')}}

                </li>
                <li>
                <!-- Show messages -->
                    {{link_to_route('gallery-create','Albums')}}

                </li>
                <li>
                    {{link_to_route('banners-index','Banners')}}
                <li>
                    {{link_to_route('account-change-password','Change Password')}}
                 </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

