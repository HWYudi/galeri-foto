import React, { useMemo } from "react";
import { Link } from "@inertiajs/inertia-react";
import { Head } from "@inertiajs/inertia-react";
import { Grid, ChevronRight } from "lucide-react";

const CategorizedPosts = ({ posts }) => {
  console.log(posts);
  const categorizedPosts = useMemo(() => {
    return posts.reduce((acc, post) => {
      if (!acc[post.JudulFoto]) {
        acc[post.JudulFoto] = [];
      }
      acc[post.JudulFoto].push(post);
      return acc;
    }, {});
  }, [posts]);

  return (
    <div className="min-h-screen bg-black text-white p-6 md:p-8 lg:p-12">
      <Head>
        <title>GO GALLERY</title>
      </Head>

      {Object.entries(categorizedPosts).map(([category, categoryPosts]) => (
        <div key={category} className="mb-16">
          <div className="flex items-center justify-between mb-8">
            <h2 className="text-2xl font-bold text-blue-500 capitalize">
              {category} Categories
            </h2>
          </div>
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            {categoryPosts.map((post) => (
              <div key={post.FotoID} className="group">
                <div className="bg-gray-900 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
                  <Link href={`/${post.user.Username}/post/${post.FotoID}`}>
                    <div className="relative">
                      <img
                        src={`/storage/${post.LokasiFile}`}
                        alt={post.DeskripsiFoto}
                        className="w-full h-48 object-cover"
                      />
                      <div className="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition duration-300">
                        <Grid className="w-10 h-10 text-white" />
                      </div>
                    </div>
                  </Link>
                  <div className="p-4">
                    <h3 className="font-semibold text-lg text-white mb-2 line-clamp-1 group-hover:text-blue-500 transition duration-300">
                      {post.DeskripsiFoto}
                    </h3>
                    <div className="flex items-center">
                      <img
                        src={
                          post.user.Image
                            ? `/storage/${post.user.Image}`
                            : "https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png"
                        }
                        alt={post.user.Username}
                        className="w-8 h-8 rounded-full object-cover mr-2"
                      />
                      <span className="text-sm text-gray-400 truncate">
                        {post.user.Username}
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      ))}
    </div>
  );
};

export default CategorizedPosts;
