import React from 'react';
import { Head } from '@inertiajs/inertia-react';

const AlbumGallery = ({ albums }) => {
  console.log(albums);
  return (
    <div className="px-2 lg:px-10 w-full">
      <Head>
        <title>GO GALLERY ALBUM</title>
      </Head>
      <div className="p-4 w-full grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
        {albums.map((album) => (
          <div key={album.AlbumID} className="relative overflow-hidden rounded-lg aspect-square">
            <a href={`/album/${album.AlbumID}`}> {/* Update to AlbumID */}
              {album.post && album.post.length > 0 ? (
                <div className="grid grid-cols-2 gap-1 h-full">
                  {album.post.slice(0, 4).map((post, index) => (
                    <img
                      key={post.FotoID} // Update to FotoID
                      src={`/storage/${post.LokasiFile}`} // Update to LokasiFile
                      alt={`${album.NamaAlbum} - ${index + 1}`} // Update to NamaAlbum
                      className={`w-full h-full object-cover ${index === 0 && album.post.length > 1 ? 'col-span-2 row-span-2' : ''}`}
                    />
                  ))}
                  {album.post.length < 4 && [...Array(4 - album.post.length)].map((_, i) => (
                    <div key={`empty-${i}`} className="bg-gray-800" />
                  ))}
                </div>
              ) : (
                <div className="w-full h-full bg-gray-800" />
              )}
              <div className="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 p-2">
                <h2 className="text-sm font-normal truncate">{album.NamaAlbum}</h2> {/* Update to NamaAlbum */}
                <p className="text-xs text-gray-400">{album.post.length} {album.post.length === 1 ? 'post' : 'posts'}</p>
              </div>
            </a>
          </div>
        ))}
      </div>
    </div>
  );
};

export default function Album({ albums }) {
  return <AlbumGallery albums={albums} />;
}
  