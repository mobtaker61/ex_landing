===========================================
Media Packages Upload Guide
===========================================

To add a new media package, you have TWO options:

OPTION 1: Local Video File
--------------------------
1. Create a new folder in this directory (media)
2. The folder name will be used as the media package name
3. Place your video file(s) in the folder (supported formats: mp4, webm, ogg, mov)
4. (Optional) Add a thumbnail.png file for the cover image

Example structure:
media/
  └── my-media-project/
      ├── video.mp4
      ├── thumbnail.png
      └── ... other files if needed


OPTION 2: YouTube Video
-----------------------
1. Create a new folder in this directory (media)
2. The folder name will be used as the media package name
3. Create a file named "youtube.txt" in the folder
4. Paste the YouTube video URL in the file (one URL per line)
5. (Optional) Add a thumbnail.png file for the cover image (otherwise YouTube thumbnail will be used)

Supported YouTube URL formats:
- https://www.youtube.com/watch?v=VIDEO_ID
- https://youtu.be/VIDEO_ID
- https://www.youtube.com/embed/VIDEO_ID
- Or just the VIDEO_ID (11 characters)

Example structure:
media/
  └── my-youtube-project/
      ├── youtube.txt (contains: https://www.youtube.com/watch?v=dQw4w9WgXcQ)
      ├── thumbnail.png (optional)
      └── ... other files if needed

After uploading, the media package will automatically appear in the list.

NOTE: If both video file and youtube.txt exist, YouTube will take priority.
