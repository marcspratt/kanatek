Updating

Change into the WordPress subrepository:

cd wordpress
git fetch --tags
git checkout 3.3.2
Replace 3.3.2 with the correct version number.

Now commit the changes subrepository version to your main project:

cd ..
git commit -m "Update WordPress to version 3.3.2"