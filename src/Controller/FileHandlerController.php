<?php

namespace BnplPartners\Factoring004Prestashop\Controller;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FileHandlerController extends FrameworkBundleAdminController
{

    private const PATH = __DIR__ . '../../../storage';

    public function upload(Request $request): JsonResponse
    {
        /**
         * @var UploadedFile $file
         */
        $file = $request->files->get('file');
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move(self::PATH, $fileName);
        } catch (FileException $e) {
            $this->json('Произошла ошибка!');
        }

        return $this->json($fileName);
    }

    public function destroy(Request $request): JsonResponse
    {
        $fileSystem = new Filesystem();
        $fileSystem->remove(self::PATH . '/' . $request->getContent());
        return $this->json('');
    }
}