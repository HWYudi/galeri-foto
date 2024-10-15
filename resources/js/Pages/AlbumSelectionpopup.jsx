import React, { useState, useEffect } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-react';

const AlbumSelectionPopup = ({ onClose, post, setIsAlbumPopupOpen }) => {
    const [albums, setAlbums] = useState([]);
    const [selectedAlbum, setSelectedAlbum] = useState('');
    const [newAlbumName, setNewAlbumName] = useState('');
    const [newAlbumDescription, setNewAlbumDescription] = useState(''); // New state for album description
    const [isCreatingNewAlbum, setIsCreatingNewAlbum] = useState(false);
    const { errors } = usePage().props;

    useEffect(() => {
        fetch(`/api/users/${post.user.UserID}/albums`)
            .then(response => response.json())
            .then(data => {
                setAlbums(data);
                setIsCreatingNewAlbum(data.length === 0);
            });
    }, [post.user.UserID]);

    const handleSubmit = (e) => {
        e.preventDefault();
        if (isCreatingNewAlbum) {
            Inertia.post('/albums', {
                nama_album: newAlbumName,
                deskripsi: newAlbumDescription, // Include description in the request
                post_id: post.FotoID
            }, {
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => {
                    setIsAlbumPopupOpen(false);
                },
                onError: (errors) => {
                    console.error('Error creating album:', errors);
                }
            });
        } else {
            Inertia.post(`/posts/${post.FotoID}/add-to-album`, {
                album_id: selectedAlbum
            }, {
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => {
                    setIsAlbumPopupOpen(false);
                },
                onError: (errors) => {
                    console.error('Error adding post to album:', errors);
                }
            });
        }
    };

    return (
        <div className="fixed z-50 inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div className="bg-white p-6 rounded-lg w-full max-w-md">
                <div className="flex justify-between items-center mb-4">
                    <h2 className="text-base text-black font-semibold">
                        {isCreatingNewAlbum ? 'Buat Album Baru' : 'Pilih atau Buat Album'}
                    </h2>
                    <button onClick={onClose} className="text-gray-500 hover:text-gray-700">
                        <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form onSubmit={handleSubmit}>
                    {errors.nama_album && <div className="text-red-500">{errors.nama_album}</div>}
                    {!isCreatingNewAlbum && albums.length > 0 && (
                        <div className="mb-4">
                            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="albumSelect">
                                Pilih Album
                            </label>
                            <select
                                id="albumSelect"
                                value={selectedAlbum}
                                onChange={(e) => setSelectedAlbum(e.target.value)}
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            >
                                <option value="">Pilih album</option>
                                {albums.map((album) => (
                                    <option key={album.AlbumID} value={album.AlbumID}>{album.NamaAlbum}</option>
                                ))}
                            </select>
                        </div>
                    )}
                    {isCreatingNewAlbum && (
                        <>
                            <div className="mb-4">
                                <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="albumName">
                                    Nama Album Baru
                                </label>
                                <input
                                    id="albumName"
                                    type="text"
                                    name="nama_album"
                                    placeholder='Tambahkan judul album'
                                    value={newAlbumName}
                                    onChange={(e) => setNewAlbumName(e.target.value)}
                                    className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                />
                            </div>
                            <div className="mb-4">
                                <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="albumDescription">
                                    Deskripsi Album
                                </label>
                                <textarea
                                    id="albumDescription"
                                    name="deskripsi"
                                    placeholder='Tambahkan deskripsi album'
                                    value={newAlbumDescription}
                                    onChange={(e) => setNewAlbumDescription(e.target.value)}
                                    className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    rows="3"
                                />
                            </div>
                        </>
                    )}
                    <div className="mb-4">
                        <div className="flex items-center">
                            <img src={post.user.Image ? "/storage/" + post.user.Image : "https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png"} alt="" className="w-8 h-8 object-cover rounded-full mr-2"/>
                            <h1 className="text-black">{post.user.Username}</h1>
                        </div>
                    </div>
                    <div className="flex justify-between">
                        {!isCreatingNewAlbum && (
                            <button
                                type="button"
                                onClick={() => setIsCreatingNewAlbum(true)}
                                className="text-blue-500 hover:text-blue-700"
                            >
                                Buat Album Baru
                            </button>
                        )}
                        {isCreatingNewAlbum && albums.length > 0 && (
                            <button
                                type="button"
                                onClick={() => setIsCreatingNewAlbum(false)}
                                className="text-blue-500 hover:text-blue-700"
                            >
                                Pilih Album Yang Ada
                            </button>
                        )}
                        <button
                            type="submit"
                            className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        >
                            {isCreatingNewAlbum ? 'Buat' : 'Simpan'}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    );
};

export default AlbumSelectionPopup;
