<?php

namespace PrestaShop\Module\TextTranslate\Service;

use Doctrine\Orm\EntityManager;
use Exception;
use PrestaShopBundle\Entity\Repository\LangRepository;
use PrestaShop\Module\TextTranslate\Repository\TabLangRepository;
use PrestaShopBundle\Entity\Repository\TranslationRepository as PrimaryTranslationRepo;
use PrestaShop\Module\TextTranslate\Repository\TranslationRepository;
use PrestaShopBundle\Entity\TabLang;
use PrestaShopBundle\Entity\Repository\TabLangRepository as PrimaryTabLangRepo;
use PrestaShopBundle\Entity\Translation;

/**
 * TranslateService class
 */
class TranslateService {

    /** @var EntityManager */
    private $em;

    /** @var TabLangRepository */
    private $tabLangRepository;

    /** @var TranslationRepository */
    private $translationRepository;
    
    /** @var PrimaryTranslationRepo */
    private $primaryTranslationRepository;

    /** @var LangRepository */
    private $langRepository;

    /**
     * Undocumented function
     *
     * @param EntityManager $em
     * @param TabLangRepository $tabLangRepository
     * @param TranslationRepository $translationRepository
     * @param LangRepository $langRepository
     */
    public function __construct(
        EntityManager $em,
        TabLangRepository $tabLangRepository,
        TranslationRepository $translationRepository,
        PrimaryTranslationRepo $primaryTranslationRepository,
        PrimaryTabLangRepo $primaryTabLangRepository,
        LangRepository $langRepository) {
            
        $this->em = $em;
        $this->tabLangRepository = $tabLangRepository;
        $this->primaryTabLangRepository = $primaryTabLangRepository;
        $this->translationRepository = $translationRepository;
        $this->primaryTranslationRepository = $primaryTranslationRepository;
        $this->langRepository = $langRepository;
    }
    /**
     * Get tablang list
     *
     * @return Collection
     */
    public function getTabLangList(){
        return $this->tabLangRepository->getAllByArray();
    }
    public function getTabLangByName($name){
        return $this->primaryTabLangRepository->findOneBy(['name' => $name]);
    }
 
    /**
     * Undocumented function
     *
     * @return array
     */
    public function getCustomeTranslationList(){
        return $this->translationRepository->getAllByArray() ?: [];
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function getCustomeTranslationById($id){
        return $this->primaryTranslationRepository->findOneBy(['id' => $id]);
    }

    /**
     * Undocumented function
     *
     * @param TabLang $tabLang
     * @return void
     */
    public function addTabLang(TabLang $tabLang){
        $this->em->persist($tabLang);
        $this->em->flush();
    }
      
    public function createOrUpdateTab(Int $id, TabLang $tablang){
        /** @var TabLang $trans */
        $trans = $this->primaryTabLangRepository->findOneBy(['id' => $id]);
        if ($trans != null) {
            $trans->setLang($tablang->getLang());
            $trans->setName($tablang->getName());
            $this->em->persist($trans);
        } else {
            $this->em->persist($tablang);
        }
        $this->em->flush();
    }
    public function createOrUpdate(Int $id, Translation $translate){
        /** @var Translation $trans */
        $trans = $this->primaryTranslationRepository->findOneBy(['id' => $id]);
        if ($trans != null) {
            $trans->setKey($translate->getKey());
            $trans->setDomain($translate->getDomain());
            $trans->setLang($translate->getLang());
            $trans->setTheme($translate->getTheme());
            $trans->setTranslation($translate->getTranslation());
            $this->em->persist($trans);
        } else {
            $this->em->persist($translate);
        }
        $this->em->flush();
    }
    /**
     * Undocumented function
     *
     * @param integer $id
     * @return void
     */
    public function deleteTranslation(int $id){
        $translation = $this->translationRepository->findOneBy(['id' => $id]);
        if ($translation) {
            $this->em->remove($translation);
            $this->em->flush();
        } else {
            throw new Exception("No found translation");
        }

    }

}