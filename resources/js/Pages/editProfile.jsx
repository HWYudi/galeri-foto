import { Inertia } from "@inertiajs/inertia";
import React, { useState } from "react";

export default function EditProfile({ user }) {
    const [image, setImage] = useState(null);
    const [username, setUsername] = useState(user.Username || "");
    const [email, setEmail] = useState(user.Email || "");
    const [namaLengkap, setNamaLengkap] = useState(user.NamaLengkap || "");
    const [alamat, setAlamat] = useState(user.Alamat || "");

    const handleSubmit = async (e) => {
        e.preventDefault();
        const formData = new FormData();

        if (image) {
            formData.append("image", image);
        }
        formData.append("username", username);
        formData.append("email", email);
        formData.append("namaLengkap", namaLengkap);
        formData.append("alamat", alamat);

        Inertia.post(`/account/edit/${user.UserID}`, formData);
    };

    return (
        <div>
            <form onSubmit={handleSubmit} encType="multipart/form-data" className="flex gap-5 lg:gap-5 px-2 py-4 lg:p-8">
                <div className="w-1/3 lg:w-fit flex flex-col items-center">
                    <label htmlFor="upload-photo" className="relative">
                        <img
                            src={image ? URL.createObjectURL(image) : `/storage/${user.Image}`}
                            alt=""
                            className="w-24 h-24 object-cover rounded-full"
                        />
                        <svg
                            className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
                            width="56"
                            height="56"
                            viewBox="0 0 56 56"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            {/* SVG path data */}
                        </svg>
                    </label>
                    <input
                        type="file"
                        accept="image/*"
                        id="upload-photo"
                        name="image"
                        onChange={(e) => setImage(e.target.files[0])}
                    />
                    <h1 className="pt-4 font-semibold">Profile Picture</h1>
                    <p className="text-xs text-white text-opacity-50">
                        PNG or JPG Up To 5MB
                    </p>
                </div>
                <div className="w-full lg:w-1/2 border-l border-white pl-5">
                    <div className="py-2">
                        <label htmlFor="username" className="text-sm font-semibold">
                            Username
                        </label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            placeholder={user.Username}
                            value={username}
                            onChange={(e) => setUsername(e.target.value)}
                            className="block w-full px-3 py-1 mt-1 text-sm border border-gray-300 rounded-md bg-transparent focus:outline-none focus:border-blue-500"
                        />
                    </div>
                    <div className="py-2">
                        <label htmlFor="email" className="text-sm font-semibold">
                            Email
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder={user.Email}
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                            className="block w-full px-3 py-1 mt-1 text-sm border border-gray-300 rounded-md bg-transparent focus:outline-none focus:border-blue-500"
                        />
                    </div>
                    <div className="py-2">
                        <label htmlFor="nama-lengkap" className="text-sm font-semibold">
                            Nama Lengkap
                        </label>
                        <input
                            type="text"
                            id="nama-lengkap"
                            name="nama-lengkap"
                            placeholder={user.NamaLengkap}
                            value={namaLengkap}
                            onChange={(e) => setNamaLengkap(e.target.value)}
                            className="block w-full px-3 py-1 mt-1 text-sm border border-gray-300 rounded-md bg-transparent focus:outline-none focus:border-blue-500"
                        />
                    </div>
                    <div className="py-2">
                        <label htmlFor="alamat" className="text-sm font-semibold">
                            Alamat
                        </label>
                        <input
                            type="text"
                            id="alamat"
                            name="alamat"
                            placeholder={user.Alamat}
                            value={alamat}
                            onChange={(e) => setAlamat(e.target.value)}
                            className="block w-full px-3 py-1 mt-1 text-sm border border-gray-300 rounded-md bg-transparent focus:outline-none focus:border-blue-500"
                        />
                    </div>
                    <div className="py-2">
                        <button
                            type="submit"
                            className="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-4 rounded w-full"
                        >
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    );
}
